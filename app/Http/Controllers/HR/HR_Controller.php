<?php

namespace App\Http\Controllers\HR;

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
use App\Mail\sendHR;

class HR_Controller extends Controller
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
        return view('hr.hr_dashboard')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3)
            ->with('theleaveform4', $theleaveform4);
    }

    public function profile_view()
    {
        return view('hr.hr_profile');
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
            return view('hr.hr_profile');
       }

    }

    public function pending()
    {
        $val = 'pending';
        $pending__view = theleaveformModel::orwhere('decl_sig', 'like', '%' . $val . '%')
        ->orwhere('super_sig', 'like', '%' . $val . '%')
        ->orwhere('hod_sig', 'like', '%' . $val . '%')
        ->orwhere('hr_sig', 'like', '%' . $val . '%')->get();
        return view('hr.hr_pending')
            ->with('pending_view', $pending__view);
    }

    public function pending_edit($id)
    {
        $pending_edit = theleaveformModel::find($id);
        return view('hr.hr_pending_edit')
            ->with('pending_edit', $pending_edit);
    }

    public function pending_update(Request $request, $id)
    {
        $p_update = theleaveformModel::find($id);
        $p_update->hr_sig = $request->input('hr_sig');
        $p_update->hr_name = $request->input('hr_name');
        $p_update->hr_email = $request->input('hr_email');


        $data = array(
            'name' => auth()->user()->name ,
            'usersName' => $request->name,
            'usersEmail' => $request->email,
            'superName' => $request->super_name,
            'superEmail' => $request->super_email,
            'hodName' => $request->hod_name,
            'hodEmail' => $request->hod_email,
        );

        $abc = theleaveformModel::find($id);

        $hostname = "smtp.google.com";
        $port = 465;

        $con = @fsockopen($hostname, $port);
        if(!$con){
            Alert::error('Email not Sent', 'Please check your internet connection');
            return redirect('/hr_pending');
        }
        else{
            foreach( [ $abc['email'] , $abc['super_email'], $abc['hod_email'] ] as $ijk ){
            Mail::to("$ijk")->queue(new sendHR($data));  }
        }

        $p_update->update();

        Alert::success('Updated', 'The Form is Successfully Updated');
        return redirect('/hr_pending');
    }

    public function hr_pending_delete($id)
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
        return view('hr.hr_approved')
            ->with('approved_view', $approved_view);
    }

    public function approved_edit($id)
    {
        $approved_edit = theleaveformModel::find($id);
        return view('hr.hr_approved_edit')
            ->with('approved_edit', $approved_edit);
    }

    public function approved_update(Request $request, $id)
    {
        $a_update = theleaveformModel::find($id);
        $a_update->hr_sig = $request->input('hr_sig');
        $a_update->update();

        Alert::success('Updated', 'The Form is Successfully Updated');
        return redirect('/hr_approved');
    }

    public function hr_approved_delete($id)
    {
        $abc_delete = theleaveformModel::findOrFail($id);
        $abc_delete->delete();

        return response()->json(['status' => 'deleted successfully']);
    }

    public function hr_calendar_index()
    {
        return view('hr.hr_calendar');
    }
}
