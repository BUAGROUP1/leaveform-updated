<?php

namespace App\Http\Controllers;

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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $auth = Auth::user()->StaffID;
        $val = 'approved';
        $val2 = 'pending';

        $theleaveform = theleaveformModel::where('StaffID', 'like', '%'. $auth . '%' )->count();
        $theleaveform2 = theleaveformModel::where('StaffID', 'like', '%' . $auth . '%')
                            ->where('decl_sig', 'like', '%' . $val . '%')
                            ->where('super_sig', 'like', '%' . $val . '%')
                            ->where('hod_sig', 'like', '%' . $val . '%')
                            ->where('hr_sig', 'like', '%' . $val . '%')->count();
        $theleaveform3 = theleaveformModel::where('StaffID', 'like', '%' . $auth . '%')
                            ->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hr_sig', 'like', '%' . $val2 . '%')->count();
        $theleaveform4 = DB::table('users')->count();

        return view('users.users_dashboard')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3)
            ->with('theleaveform4', $theleaveform4);
        }
        
        
}
