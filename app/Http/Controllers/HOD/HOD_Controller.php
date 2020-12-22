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
use App\Mail\HOD\sendHOD_leave;

class HOD_Controller extends Controller
{
    public function index()
    {
        $val = 'approved';
        $val3 = 'hod';
        $val4 = auth()->user()->department;

        $theleaveform = theleaveformModel::where('department', "$val4")->count();

        $theleaveform2 = theleaveformModel::where('department', "$val4")
                            ->where('decl_sig', 'like', '%' . $val . '%')
                            ->where('super_sig', 'like', '%' . $val . '%')
                            ->where('hod_sig', 'like', '%' . $val . '%')
                            ->where('hr_sig', 'like', '%' . $val . '%')->count();

        $theleaveform3 = theleaveformModel::where('department', "$val4")
                            ->where(function($bbc){
                                $val2 = 'pending';
                            return $bbc
                            ->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hr_sig', 'like', '%' . $val2 . '%');
                            })->count();


        return view('hod.hod_dashboard')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3);
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
           $filename = auth()->user()->name . '.' . $avatar->getClientOriginalExtension();
/* me */   if($avatar->getClientOriginalExtension() !== 'jpg'){
            Alert::error('File extension not supported', 'Use only .jpg');
            return view('hod.hod_profile');
        }
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

        $val2 = auth()->user()->department;
        $pending__view = theleaveformModel::where('department', "$val2")->where(function($bbc){
            $val = 'pending';
            return $bbc
            ->orwhere('decl_sig', 'like', '%' . $val . '%')
            ->orwhere('super_sig', 'like', '%' . $val . '%')
            ->orwhere('hod_sig', 'like', '%' . $val . '%')
            ->orwhere('hr_sig', 'like', '%' . $val . '%');
        })->get();
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

        $hostname = "www.google.com";
        $port = 80;

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
        $val2 = auth()->user()->department;
        $approved_view = theleaveformModel::where('department', "$val2")
        ->where('decl_sig', 'like', '%' . $val . '%')
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
    public function hod_leaveform_index()
    {
        return view('hod.hod_leaveform');
    }
    public function hod_submit_leave(Request $req)
    {
        $user = new theleaveformModel;
        $user->StaffID= $req->StaffID;
        $user->date= $req->date;
        $user->name= $req->name;
        $user->sapno= $req->sapno;
        $user->cadre= $req->cadre;
        $user->department= $req->department;
        $user->shift= $req->shift;
        $user->leavetype= $req->leavetype;
        $user->reason= $req->reason;
        $user->leaveyear= $req->leaveyear;
        $user->entitledleave= $req->entitledleave;
        $user->daystaken= $req->daystaken;
        $user->totdaysvac= $req->totdaysvac;
        $user->outstanding= $req->outstanding;
        $user->publicholidays= $req->publicholidays;
        $user->lcommences= $req->lcommences;
        $user->lends= $req->lends;
        $user->rdate= $req->rdate;
        $user->contact_add= $req->contact_add;
        $user->phone= $req->phone;
        $user->email= $req->email;
        $user->decl= $req->decl;
        $user->decl_sig= $req->decl_sig;
        $user->decl_date= $req->decl_date;
        $user->super_sig= $req->super_sig;
        $user->super_date= $req->super_date;
        $user->hod_sig= $req->hod_sig;
        $user->hod_date= $req->hod_date;
        $user->hr_sig= $req->hr_sig;
        $user->hr_date= $req->hr_date;


        $data = array(
            'hod_name' => $req->name,
            'hod_department' => $req->department,
            'hod_email' => $req->email
        );

        $val = 'hr';

        $abc = User::where('usertype', 'like', '%' . $val . '%')
                            ->get(['email']);

        $hostname = "www.google.com";
        $port = 80;

        $con = @fsockopen($hostname, $port);

        if (!$con) {
          Alert::error('Email not Sent', 'Please check your internet connection');
          return redirect('/hod_dashboard');
        } else {
            $user->save();
            foreach ( $abc as $xyz ) {
            Mail::to("$xyz->email")->send(new sendHOD_leave($data)); }
        }


        Alert::success('Submitted', 'The Form is Successfully Submitted');
        return view('/hod_dashboard');
    }
    public function hod_status_index()
    {
        $val = 'approved';
        $val3 = auth()->user()->email;

        $theleaveform = theleaveformModel::where('email', "$val3")->count();

        $theleaveform2 = theleaveformModel::where('email', "$val3")
                            ->where('decl_sig', 'like', '%' . $val . '%')
                            ->where('super_sig', 'like', '%' . $val . '%')
                            ->where('hod_sig', 'like', '%' . $val . '%')
                            ->where('hr_sig', 'like', '%' . $val . '%')->count();
        $theleaveform3 = theleaveformModel::where('email', "$val3")
                            ->where(function($bbc){
                                $val2 = 'pending';
                                return $bbc
                                ->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('hr_sig', 'like', '%' . $val2 . '%');
                            })->count();
        return view('hod.hod_status')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3);
    }
    public function hod_status_approved()
    {
        $val = auth()->user()->email;
        $val2 = 'approved';

        $abc = theleaveformModel::where('email', "$val")
        ->where('decl_sig', 'like', '%' . $val2 . '%')
        ->where('super_sig', 'like', '%' . $val2 . '%')
        ->where('hod_sig', 'like', '%' . $val2 . '%')
        ->where('hr_sig', 'like', '%' . $val2 . '%')->get();
        return view('hod.hod_status_approved')
            ->with('abc', $abc);
    }
    public function hod_status_pending()
    {
        $val = auth()->user()->email;
        $abc = theleaveformModel::where('email', "$val")
                            ->where(function($bbc){
                                $val2 = 'pending';
                                return $bbc
                                ->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                                ->orwhere('hr_sig', 'like', '%' . $val2 . '%');
                            })->get();
        return view('hod.hod_status_pending')
            ->with('abc', $abc);
    }

}

