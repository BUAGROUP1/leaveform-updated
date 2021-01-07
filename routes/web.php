<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testing', function () {
    return view('admin.admin_dashboard');
});

//error for users
Route::get('/u_view_errors', function () {
    return view('errors.u_view_errors');
});
//error for admin
Route::get('/a_view_errors', function () {
    return view('errors.a_view_errors');
});
//error for all
Route::get('/all_view_errors', function () {
    return view('errors.all_view_errors');
});

Auth::routes();



// USER MIDDLEWARE

Route::group(['middleware' => ['auth', 'is_user']], function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/leaveform-page', 'TheUsers\leaveformController@index');
Route::post('submit_leave', 'TheUsers\leaveformController@save');

Route::put('ubtn_profile_update', 'TheUsers\UsersController@profile_update');
Route::put('ubtn_profile_password', 'TheUsers\UsersController@password_update');
Route::get('/user_profile', 'TheUsers\UsersController@profile_view');
Route::post('/u_profile_image_update', 'TheUsers\UsersController@insert_profile_image');
Route::get('/user_calendar', 'TheUsers\UsersController@user_calendar_index');
Route::get('/users_pending', 'TheUsers\UsersController@users_pending');
Route::get('/users_approved', 'TheUsers\UsersController@users_approved');

});

// END USER MIDDLEWARE


// ADMIN MIDDLEWARE

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', 'Admin\DashboardController@index');

    Route::get('/usermanagement', 'Admin\DashboardController@usermanaged');
    Route::get('/role-edit/{id}', 'Admin\DashboardController@usermanagededit');
    Route::put('/role-user-update/{id}', 'Admin\DashboardController@usermanagedupdate');
    Route::delete('/role-delete/{id}', 'Admin\DashboardController@usermanageddelete');
    Route::get('/approved', 'Admin\DashboardController@approved');
    Route::get('/pending', 'Admin\DashboardController@pending');
    Route::get('/pending_edit/{id}', 'Admin\DashboardController@pending_edit');
    Route::put('/pending_update/{id}', 'Admin\DashboardController@pending_update');

    //old routes for deleteing
    Route::delete('/pending_delete/{id}', 'Admin\DashboardController@pending_delete');
    Route::delete('/approved_delete/{id}', 'Admin\DashboardController@approved_delete');
    //end old routes for deleting

    Route::get('/approved_edit/{id}', 'Admin\DashboardController@approved_edit');
    Route::put('/approved_update/{id}', 'Admin\DashboardController@approved_update');
    Route::get('/admin_profile', 'Admin\DashboardController@profile_view');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    //delete pending with ajax & sweetalert
    Route::delete('/a_pending_delete/{id}','Admin\DashboardController@a_pending_delete');
    //delete pending
    Route::delete('/a_approved_delete/{id}','Admin\DashboardController@a_approved_delete');
    //for the profile
    Route::post('/a_profile_image_update', 'Admin\DashboardController@insert_profile_image');
    Route::get('/admin_calendar', 'Admin\DashboardController@admin_calendar_index');
    Route::get('/admin_leaveform', 'Admin\DashboardController@admin_leaveform_index');
    Route::post('admin_submit_leave', 'Admin\DashboardController@admin_leaveform_save');

});

//end ADMIN MIDDLEWARE


//HR MIDDLEWARE
Route::group(['middleware' => ['auth', 'is_hr']], function () {

    Route::get('/hr_dashboard', 'HR\HR_Controller@index');
    Route::get('/hr_profile', 'HR\HR_Controller@profile_view');
    Route::put('hr_profile_update', 'HR\HR_Controller@profile_update');
    Route::put('hr_profile_password', 'HR\HR_Controller@password_update');
    Route::post('/hr_profile_image_update', 'HR\HR_Controller@insert_profile_image');
    ////
    Route::get('/hr_pending', 'HR\HR_Controller@pending');
    Route::get('/hr_pending_edit/{id}', 'HR\HR_Controller@pending_edit');
    Route::put('/hr_pending_update/{id}', 'HR\HR_Controller@pending_update');
    Route::delete('/hr_pending_delete/{id}','HR\HR_Controller@hr_pending_delete');
    ////
    Route::get('/hr_approved', 'HR\HR_Controller@approved');
    Route::get('/hr_approved_edit/{id}', 'HR\HR_Controller@approved_edit');
    Route::put('/hr_approved_update/{id}', 'HR\HR_Controller@approved_update');
    Route::delete('/hr_approved_delete/{id}','HR\HR_Controller@hr_approved_delete');
    Route::get('/hr_calendar', 'HR\HR_Controller@hr_calendar_index');
    Route::get('/hr_leaveform', 'HR\HR_Controller@hr_leaveform_index');
    Route::post('hr_submit_leave', 'HR\HR_Controller@hr_leaveform_save');
    Route::get('/hr_status', 'HR\HR_Controller@hr_status_index');
    Route::get('/hr_status_pending', 'HR\HR_Controller@hr_status_pending');
    Route::get('/hr_status_approved', 'HR\HR_Controller@hr_status_approved');
});
//END HR MIDDLEWARE

//SUPERVISOR MIDDLEWARE
Route::group(['middleware' => ['auth', 'is_supervisor']], function () {

    Route::get('/supervisor_dashboard', 'Supervisor\SupervisorController@index');
    Route::get('/supervisor_profile', 'Supervisor\SupervisorController@profile_view');
    Route::put('s_profile_update', 'Supervisor\SupervisorController@profile_update');
    Route::put('s_profile_password', 'Supervisor\SupervisorController@password_update');
    Route::post('/s_profile_image_update', 'Supervisor\SupervisorController@insert_profile_image');

    Route::get('/supervisor_pending', 'Supervisor\SupervisorController@pending');
    Route::get('/s_pending_edit/{id}', 'Supervisor\SupervisorController@pending_edit');
    Route::put('/s_pending_update/{id}', 'Supervisor\SupervisorController@pending_update');
    Route::delete('/s_pending_delete/{id}','Supervisor\SupervisorController@s_pending_delete');

    Route::get('/supervisor_approved', 'Supervisor\SupervisorController@approved');
    Route::get('/s_approved_edit/{id}', 'Supervisor\SupervisorController@approved_edit');
    Route::put('/s_approved_update/{id}', 'Supervisor\SupervisorController@approved_update');
    Route::delete('/s_approved_delete/{id}','Supervisor\SupervisorController@s_approved_delete');
    Route::get('/supervisor_calendar', 'Supervisor\SupervisorController@supervisor_calendar_index');
    Route::get('/supervisor_leaveform', 'Supervisor\SupervisorController@supervisor_leaveform_index');
    Route::post('supervisor_submit_leave', 'Supervisor\SupervisorController@supervisor_leaveform_save');
    Route::get('/supervisor_status', 'Supervisor\SupervisorController@supervisor_status_index');
    Route::get('/supervisor_status_approved', 'Supervisor\SupervisorController@supervisor_status_approved');
    Route::get('/supervisor_status_pending', 'Supervisor\SupervisorController@supervisor_status_pending');

});
//END SUPERVISOR MIDDLEWARE


//HOD MIDDLEWARE
Route::group(['middleware' => ['auth', 'is_hod']], function () {
    Route::get('/hod_dashboard', 'HOD\HOD_Controller@index');
    Route::get('/hod_profile', 'HOD\HOD_Controller@profile_view');
    Route::put('hod_profile_update', 'HOD\HOD_Controller@profile_update');
    Route::put('hod_profile_password', 'HOD\HOD_Controller@password_update');
    Route::post('/hod_profile_image_update', 'HOD\HOD_Controller@insert_profile_image');

    Route::get('/hod_pending', 'HOD\HOD_Controller@pending');
    Route::get('/hod_pending_edit/{id}', 'HOD\HOD_Controller@pending_edit');
    Route::put('/hod_pending_update/{id}', 'HOD\HOD_Controller@pending_update');
    Route::delete('/hod_pending_delete/{id}','HOD\HOD_Controller@hod_pending_delete');

    Route::get('/hod_approved', 'HOD\HOD_Controller@approved');
    Route::get('/hod_approved_edit/{id}', 'HOD\HOD_Controller@approved_edit');
    Route::put('/hod_approved_update/{id}', 'HOD\HOD_Controller@approved_update');
    Route::delete('/hod_approved_delete/{id}','HOD\HOD_Controller@hod_approved_delete');
    Route::get('/hod_calendar', 'HOD\HOD_Controller@hod_calendar_index');
    Route::get('/hod_leaveform', 'HOD\HOD_Controller@hod_leaveform_index');
    Route::get('/hod_status', 'HOD\HOD_Controller@hod_status_index');
    Route::get('/hod_status_approved', 'HOD\HOD_Controller@hod_status_approved');
    Route::get('/hod_status_pending', 'HOD\HOD_Controller@hod_status_pending');
    Route::post('hod_submit_leave', 'HOD\HOD_Controller@hod_submit_leave');
});
//END HOD MIDDLEWARE
