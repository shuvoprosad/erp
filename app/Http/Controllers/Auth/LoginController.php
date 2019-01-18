<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     */
    //protected $redirectTo = 'create';
    
    protected function redirectTo()
    {
        //$user = Auth::user();
        // switch(true) {
        //     case $user->isInstructor():
        //         return '/instructor';
        //     case $user->isAdmin():
        //     case $user->isSuperAdmin():
        //         return '/admin';
        //     default:
        //         return '/account';
        // }

        return route('users.index');
    }



}
