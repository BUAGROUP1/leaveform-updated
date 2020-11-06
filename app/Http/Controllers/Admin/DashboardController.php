<?php

namespace App\Http\Controllers\Admin;

use App\Models\theleaveformModel;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $theleaveform = theleaveformModel::all()->count();

        $val = 'approved';
        $theleaveform2 = DB::table('theleaveform')->select('status')->where('status', 'like', '%' . $val . '%')->count();
        $theleaveform3 = DB::table('theleaveform')->whereNull('status')->count();
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

        $pending__view = theleaveformModel::whereNull('status')->get();

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
}
