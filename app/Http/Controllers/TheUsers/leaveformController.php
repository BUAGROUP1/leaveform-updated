<?php

namespace App\Http\Controllers\TheUsers;

use Auth;
use App\Models\User;
use App\Models\theleaveformModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendUser;

class leaveformController extends Controller

{

    public function index()
    {
        return view('users.leaveform-page');
    }

    function save(Request $req)
    {
        /*print_r($req->input());*/
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
            'name' => $req->name
        );

        $val = 'supervisor';
        $val2 = auth()->user()->department;

        $abc = User::where('usertype', 'like', '%' . $val . '%')
                            ->where('department', 'like', '%' . $val2 . '%')
                            ->get(['email']);

        $hostname = "www.google.com";
        $port = 80;

        $con = @fsockopen($hostname, $port);

        if (!$con) {
          Alert::error('Email not Sent', 'Please check your internet connection');
          return redirect('/home');
        } else {
            $user->save();
            foreach ( $abc as $xyz ) {
            Mail::to("$xyz->email")->send(new sendUser($data)); }
        }


        Alert::success('Submitted', 'The Form is Successfully Submitted');
        return redirect('/home');
    }





}
