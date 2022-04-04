<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = "/choose-option";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     //redirect user back to previous page before login
    //  public function showLoginForm()
    //  {
    //      if(!session()->has('url.intended'))
    //      {
    //          session(['url.intended' => url()->previous()]);
    //      }
    //      return view('auth.login');    
    //  }

    //method called when user is authenticated
    protected function authenticated()
    {
        $role = Auth::user()->role;

        if($role == "Corperate")
        {
            return redirect("/cooperate-customer-dashboard");

        }
        else
        {
            return redirect("/choose-option");


        }
    }
}

