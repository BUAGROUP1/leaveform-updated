<?php

namespace App\Http\Controllers\HOD;

use App\Models\theleaveformModel;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Images;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendHOD;

class HOD_Controller extends Controller
{
    public function index()
    {
        $theleaveform = theleaveformModel::all()->count();

        $val = 'approved';
        $val2 = 'pending';
        $theleaveform2 = theleaveformModel::where('decl_sig', 'like', '%' . $val . '%')
                            ->where('super_sig', 'like', '%' . $val . '%')
                            ->where('hod_sig', 'like', '%' . $val . '%')
                            ->where('hr_sig', 'like', '%' . $val . '%')->count();
        $theleaveform3 = theleaveformModel::orwhere('decl_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hr_sig', 'like', '%' . $val2 . '%')->count();
        $theleaveform4 = DB::table('users')->count();
        return view('hod.hod_dashboard')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3)
            ->with('theleaveform4', $theleaveform4);
    }

    public function profile_view()
    {
        return view('hod.hod_profile');
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
           $filename = auth()->user()->name . '.' . $avatar->getClientOriginalExtension() ;
           Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );
           $user = Auth::user();
           $user->avatar =$filename;
           $user->save();

           Alert::success('Updated', 'Profile Picture is Successfully Updated');
            return view('hod.hod_profile');
       }

    }

    public function pending()
    {
        $val = 'pending';
        $pending__view = theleaveformModel::orwhere('decl_sig', 'like', '%' . $val . '%')
        ->orwhere('super_sig', 'like', '%' . $val . '%')
        ->orwhere('hod_sig', 'like', '%' . $val . '%')
        ->orwhere('hr_sig', 'like', '%' . $val . '%')->get();
        return view('hod.hod_pending')
            ->with('pending_view', $pending__view);
    }

    public function pending_edit($id)
    {
        $pending_edit = theleaveformModel::find($id);
        return view('hod.hod_pending_edit')
            ->with('pending_edit', $pending_edit);
    }

    public function pending_update(Request $request, $id)
    {

        $p_update = theleaveformModel::find($id);
        $p_update->hod_sig = $request->input('hod_sig');
        $p_update->hod_name = $request->input('hod_name');
        $p_update->hod_email = $request->input('hod_email');
        $p_update->update();

        $data = array(
            'name' => auth()->user()->name,
            'superName' => $request->super_name,
            'superEmail' => $request->super_email,
            'usersName' => $request->name
        );

        $val = 'hr';

        $abc = User::where('usertype', 'like', '%' . $val . '%')
                            ->get('email');

        $hostname = "smtp.google.com";
        $port = 465;

        $con = @fsockopen($hostname, $port);
        if(!$con){
            Alert::error('Email not Sent', 'Please check your internet connection');
            return redirect('/hod_pending');
        }
        else{
            foreach ( $abc as $xyz ) {
            Mail::to("$xyz->email")->send(new sendHOD($data)); }
        }

        Alert::success('Updated', 'The Form is Successfully Approved');
        return redirect('/hod_pending');
    }

    public function hod_pending_delete($id)
    {
        $abc_delete = theleaveformModel::findOrFail($id);
        $abc_delete->delete();

        return response()->json(['status' => 'deleted successfully']);
    }

    ////////////

    public function approved()
    {
        $val = 'approved';
        $approved_view = theleaveformModel::where('decl_sig', 'like', '%' . $val . '%')
        ->where('super_sig', 'like', '%' . $val . '%')
        ->where('hod_sig', 'like', '%' . $val . '%')
        ->where('hr_sig', 'like', '%' . $val . '%')->get();
        return view('hod.hod_approved')
            ->with('approved_view', $approved_view);
    }

    public function approved_edit($id)
    {
        $approved_edit = theleaveformModel::find($id);
        return view('hod.hod_approved_edit')
            ->with('approved_edit', $approved_edit);
    }

    public function approved_update(Request $request, $id)
    {
        $a_update = theleaveformModel::find($id);
        $a_update->hod_sig = $request->input('hod_sig');
        $a_update->update();

        Alert::success('Updated', 'The Form is Successfully Updated');
        return redirect('/hod_approved');
    }

    public function hod_approved_delete($id)
    {
        $abc_delete = theleaveformModel::findOrFail($id);
        $abc_delete->delete();

        return response()->json(['status' => 'deleted successfully']);
    }

    public function hod_calendar_index()
    {
        return view('hod.hod_calendar');
    }
}
