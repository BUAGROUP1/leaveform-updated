<?php

namespace App\Http\Controllers\TheUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Images;
use App\Models\theleaveformModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class UsersController extends Controller
{
    public function profile_view()
    {
        return view('users.users_profile');
    }

    public function profile_update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        Alert::success('Updated', 'Profile is Successfully Updated');
        return back();
    }

    public function password_update(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        Alert::success('Updated', 'Password is Successfully Updated');
        return back();
    }

    public function insert_profile_image(Request $request)
    {
       if($request->hasFile('avatar')){
           $avatar = $request->file('avatar');
           $filename = auth()->user()->name . '.' . $avatar->getClientOriginalExtension();
/* me */   if($avatar->getClientOriginalExtension() !== 'jpg'){
            Alert::error('File extension not supported', 'Use only .jpg');
            return view('users.users_profile');
        }
           Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );
           $user = Auth::user();
           $user->avatar =$filename;
           $user->save();

           Alert::success('Updated', 'Profile Picture is Successfully Updated');
            return view('users.users_profile');
       }

    }

    public function user_calendar_index()
    {
        return view('users.user_calendar');
    }

    public function users_pending()
    {
        $val = auth()->user()->email;

        $abc = theleaveformModel::where('email', 'like', '%' . $val . '%')->where(function($bbc){
            $val2 = 'pending';
          return $bbc->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                    ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                    ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                    ->orwhere('hr_sig', 'like', '%' . $val2 . '%');
        })->get();


        return view('users.users_pending')
            ->with('abc', $abc);
    }

    public function users_approved()
    {
        $val = auth()->user()->email;
        $val2 = 'approved';

        $abc = theleaveformModel::where('email', 'like', '%' . $val . '%')
        ->where('decl_sig', 'like', '%' . $val2 . '%')
        ->where('super_sig', 'like', '%' . $val2 . '%')
        ->where('hod_sig', 'like', '%' . $val2 . '%')
        ->where('hr_sig', 'like', '%' . $val2 . '%')->get();

        return view('users.users_approved')
            ->with('abc', $abc);
    }

}
