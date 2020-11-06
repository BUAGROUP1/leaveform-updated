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

//error fr users
Route::get('/u_view_errors', function () {
    return view('errors.u_view_errors');
});
//error for admin
Route::get('/a_view_errors', function () {
    return view('errors.a_view_errors');
});

Auth::routes();

// normal user routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/leaveform-page', 'TheUsers\leaveformController@index');
Route::post('submit_leave', 'TheUsers\leaveformController@save');

//Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

// end normal user routes

//admin routes -------------

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', 'Admin\DashboardController@index'); /*function () {
        return view('admin.dashboard');
    });*/

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
    //delete pending with ajax & sweetalert
    Route::delete('/a_pending_delete/{id}','Admin\DashboardController@a_pending_delete');
    //delete pending
    Route::delete('/a_approved_delete/{id}','Admin\DashboardController@a_approved_delete');
    
});

//end normal user routes ------------