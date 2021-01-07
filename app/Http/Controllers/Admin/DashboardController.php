<?php

namespace App\Http\Controllers\Admin;

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


class DashboardController extends Controller
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

        return view('admin.admin_dashboard')
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3)
            ->with('theleaveform4', $theleaveform4);
    }

    /* public function index2()
    {
        $val ='approved';
        $theleaveform2 = DB::table('theleaveform')->select('status')->where('status', 'like', '%' . $val . '%')->count();

            return view('admin.dashboard')->with('theleaveform2', $theleaveform2);

    }*/

    public function usermanaged()
    {
        $users = User::all();
        return view('admin.usermanagement ')->with('users', $users);
    }

    public function usermanagededit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.usermanagement-edit')->with('users', $users);
    }

    public function usermanagedupdate(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->update();

        return redirect('/usermanagement');;
    }

    public function usermanageddelete($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/UserManagement')->with('status', 'Your Data is Deleted');
    }



    public function approved()
    {
        $val = 'approved';
        $approved_view = theleaveformModel::where('status', 'like', '%' . $val . '%')->get();
        return view('admin.admin_approved')
            ->with('approved_view', $approved_view);
    }

    public function pending()
    {
        $val = 'pending';
        $pending__view = theleaveformModel::where('status', 'like', '%' . $val . '%')->get();

        return view('admin.admin_pending')
            ->with('pending_view', $pending__view);
    }

    public function pending_edit($id)
    {
        $pending_edit = theleaveformModel::find($id);
        return view('admin.admin_pending_edit')
            ->with('pending_edit', $pending_edit);
    }

    public function pending_update(Request $request, $id)
    {
        $p_update = theleaveformModel::find($id);
        $p_update->status = $request->input('status');
        $p_update->update();

        Alert::success('Updated', 'The Form is Successfully Updated');
        return redirect('/pending');
    }

    public function pending_delete($id)
    {
        $p_delete = theleaveformModel::findOrFail($id);
        $p_delete->delete();

        Alert::success('Updated', 'The Form is Successfully DELETED');
        return redirect('/pending');

        /*return response()->json(['status'=>'Pending form deleted successfully']);*/
    }

    public function approved_edit($id)
    {
        $approved_edit = theleaveformModel::find($id);
        return view('admin.admin_approved_edit')
            ->with('approved_edit', $approved_edit);
    }

    //old function for deleting
    public function approved_delete($id)
    {
        $a_delete = theleaveformModel::findOrFail($id);
        $a_delete->delete();

        Alert::success('Updated', 'The Form is Successfully DELETED');
        return redirect('/approved');
    }

    public function approved_update(Request $request, $id)
    {
        $a_update = theleaveformModel::find($id);
        $a_update->status = $request->input('status');
        $a_update->update();

        Alert::success('Updated', 'The Form is Successfully Updated');
        return redirect('/approved');
    }

    public function profile_view()
    {

        return view('admin.admin_profile');
    }

    //new function for deleting with ajax & sweet alert
    public function a_pending_delete($id)
    {
        $abc_delete = theleaveformModel::findOrFail($id);
        $abc_delete->delete();

        return response()->json(['status' => 'deleted successfully']);
    }

    public function a_approved_delete($id)
    {
        $abc_delete = theleaveformModel::findOrFail($id);
        $abc_delete->delete();

        return response()->json(['status' => 'deleted successfully']);
    }
    // end new function for deleting with ajax and sweet alert

    public function insert_profile_image(Request $request)
    {
       if($request->hasFile('avatar')){
           $avatar = $request->file('avatar');
           $filename = auth()->user()->name . '.' . $avatar->getClientOriginalExtension();
/* me */   if($avatar->getClientOriginalExtension() !== 'jpg'){
            Alert::error('File extension not supported', 'Use only .jpg');
            return view('admin.admin_profile');
        }
           Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );
           $user = Auth::user();
           $user->avatar =$filename;
           $user->save();

           Alert::success('Updated', 'Profile Picture is Successfully Updated');
            return view('admin.admin_profile');
       }

    }

    public function admin_calendar_index()
    {
        return view('admin.admin_calendar');
    }

    public function admin_leaveform_index()
    {
        return view('admin.admin_leaveform');
    }

    public function admin_leaveform_save(Request $req)
    {   $user = new theleaveformModel;
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
        
        return view('name');
    }
}
