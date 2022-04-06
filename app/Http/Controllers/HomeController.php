<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

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
        if (Auth::user()) {
            $role = Auth::user()->role;

            if ($role == "Corperate") {
                return view("cooperate-customer.dashboard");
            } else {
                return view("choose-option");
            }
        } else {
            return redirect("/login");
        }
    }
}
