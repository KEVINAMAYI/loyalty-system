<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Account;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/cooperate-customer-dashboard";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phonenumber' => 'required|regex:(^07)|digits:10',
            'alternativephonenumber' =>'required|regex:(^07)|digits:10',
            'address' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'krapin' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
    
         // upload company logo
         $companyLogo =  "image-".time().'.'.$data['company_logo_image']->getClientOriginalExtension();
         $data['company_logo_image']->move(public_path('images'), $companyLogo);

         $user = User::create([
            'name' => strtoupper($data['name']),
            'phone_number' => $data['phonenumber'],
            'address' => $data['address'],
            'town' => $data['town'],
            'krapin' => $data['krapin'],
            'alternative_phone_number' => $data['alternativephonenumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Corperate',
            'logo_url' => $companyLogo
        ]);


         Account::create([
            'organization_id' => $user->id,
            'account_number' => 000000000,
            'account_limit' => 100000,
            'account_balance' =>0,
            'limit_utilized' => 0,
            'discount' => 0,
            'account_type' => 'credit'
        ]);


         Account::create([
            'organization_id' => $user->id,
            'account_number' => 000000000,
            'account_limit' => 100000,
            'account_balance' =>0,
            'limit_utilized' => 0,
            'discount' => 0,
            'account_type' => 'prepaid'
        ]);

        return  $user;


    }
}
