<?php

namespace App\Http\Controllers;


use Config;
use Exception;
use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Twilio\Rest\Client;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\AuthorizedPurchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        if(Auth::user())
        {
            $role = Auth::user()->role;

            if($role == "Corperate")
            {
                $user = Auth::user()->name;
                $employees = Customer::where('type','=',$user)->get();
                $vehicles =  Vehicle::where('ownership','=', $user)->get();
                $employees_count = Customer::where('type','=',$user)->get();
                $vehicles_count = Vehicle::where('ownership','=', $user)->get();
                $autorizedpurchases = AuthorizedPurchase::where('name','=', $user)->get();
                $autorizedpurchases_count = AuthorizedPurchase::where('name','=', $user)->get();
                $employees_authorized_data = array();
                $company = User::where('id','=',$user)->get();
        
        
                foreach ($autorizedpurchases as $autorizedpurchase)
                {
                    $customerid = $autorizedpurchase->employee_id;
                    $vehicleid = $autorizedpurchase->vehicle_id;
                    $personal_data = Customer::where('id','=',$customerid)->get();
                    $vehicle_data = Vehicle::where('id','=',$vehicleid)->get();
        
        
                    $employee = array();
        
                    array_push($employee, $personal_data);
                    array_push($employee, $vehicle_data);
                    array_push($employee,  $autorizedpurchase);
                    array_push($employees_authorized_data,$employee);
        
                }
        
                 return view('cooperate-customer.dashboard')->with([
                                                'employees' => $employees,
                                                'vehicles' => $vehicles,
                                                'employees_count' => $employees_count,
                                                'vehicle_count' => $vehicles_count,
                                                'authorized_purchases_count' => $autorizedpurchases_count,
                                                'authorized_purchases' => $employees_authorized_data, 'company' => $company]);
               
               
    
            }
            else
            {
                return view("choose-option");
    
    
            }

        }
        else
        {
            return redirect("/login");
        }
       
    }
}
