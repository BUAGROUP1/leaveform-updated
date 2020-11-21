<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {   
        //admin login
        if(Auth::user()->usertype == 'user')
       {
            toast('Logged IN','success');
            return 'home';
       }
       if(Auth::user()->usertype == 'admin')
       {
            toast('Logged IN as Admin','success');
            return 'dashboard';
       }
       // 
       if(Auth::user()->usertype == 'supervisor')
       {
            toast('Logged IN as Supervisor','success');
            return 'supervisor_dashboard';
       }

       if(Auth::user()->usertype == 'hr')
       {
            toast('Logged IN as HR','success');
            return 'hr_dashboard';
       }

       if(Auth::user()->usertype == 'hod')
       {
            toast('Logged IN as HOD','success');
            return 'hod_dashboard';
       }      
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
