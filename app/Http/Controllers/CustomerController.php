<?php

namespace App\Http\Controllers;

use Config;
use Exception;
use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Twilio\Rest\Client;
use App\Models\Customer;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AuthorizedPurchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;





class CustomerController extends Controller
{


    // register corporate customer from staff dashboard
    public function registerCorporate(Request $request)
    {

        // dd($request->all());
         //validate new staff details
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phonenumber' => 'required',
            'alternativephonenumber' =>'required',
            'address' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'krapin' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'contact_person_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_person_phone' => 'required',
            'contact_person_alternative_phone' => 'required'
            
         ]);

         $data = $request->all();

         //define a default account number
         $default_account_number = intval(substr(str_shuffle('0123456789'),0,7));  
    
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
            'logo_url' => $companyLogo,
            'contact_person_name' => $data['contact_person_name'],
            'contact_person_email' => $data['contact_person_email'],
            'contact_person_phone' =>  $data['contact_person_phone'],
            'contact_person_alternative_phone' => $data['contact_person_alternative_phone']
        ]);


         Account::create([
            'organization_id' => $user->id,
            'account_number' => $default_account_number,
            'account_limit' => 0,
            'account_balance' =>0,
            'limit_utilized' => 0,
            'discount' => 0,
            'account_type' => 'credit'
        ]);


         Account::create([
            'organization_id' => $user->id,
            'account_number' => $default_account_number,
            'account_limit' => 0,
            'account_balance' =>0,
            'limit_utilized' => 0,
            'discount' => 0,
            'account_type' => 'prepaid'
        ]);


        session()->flash('success','Coporate Added Successfully');
        return redirect()->back();

    }

    //get corporate company info
    public function getCompanyInfo()
    {   
        $user = Auth::user()->id;
        $company = User::where('id','=',$user)->get();
        return view('cooperate-customer.company-info')->with(['company' => $company]);

    }

    public function getRegisteredCorporates()
    {   
        if(Auth::user()->major_role == 'Admin')
        {
        $corporates_accounts = Account::all();
        // $corporates = User::where('role','=','Corperate')->get();
        return view('staff.corporates')->with(['corporates_accounts' => $corporates_accounts]);
        }
        else
        {
            return redirect('/choose-option');
        }
    }

    //generate sms token
    public function smsToken()
    {   


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.emalify.com/v1/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "client_id" : "bebWKRRVZaPvCb4o3JSfqWmidlqxjOdo",
                "client_secret" : "WgLRBAKoBJ0fsXbYe1TMxqCGSN7mWg1mZ6mC5si3",
                "grant_type" : "client_credentials"
                    }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));
        $curl_response = curl_exec($curl);
        $access_token  = json_decode($curl_response);

        curl_close($curl);
        return $access_token->access_token;
    }

    //send SMS using emalify
    public function sendSms($message, $phone_number)
    {
        $token = $this->smsToken();

        $url = "https://api.emalify.com/v1/projects/nvk85q40v8mjpdxz/sms/simple/send";
        $post_fields = array(
            'to' => [$phone_number],
            "message" => $message,
            "from" => "KCT_LTD"
        );
        $body = json_encode($post_fields);

        $curl  = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL        => $url,
                CURLOPT_HEADER     => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $body,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type:application/json',
                    'Authorization:Bearer ' . $token,
                ),
            )
        );

        $response = curl_exec($curl);
        Log::info($response);
        return $response;
    }



    public function sendSalesConfirmationSMS(Request $request)
    {   
        $receiverNumber = "+254".substr($request->phone_number,1);
        $message = "Sales Completed successfully, Thanks and shop with us again";
        $data = $request->all();

        //get customer purchase
         Customer::where('id','=',$data['customer_id'])->update([
            'rewards' => $data['new_cutomer_rewards'],
            'sale_start_date' => $data['sale_end_date'],
            'sale_end_date' => $data['sale_end_date'],

        ]);


        //get the updated customer
        $customer = Customer::where('id','=',$data['customer_id'])->get();

        //update status for authorized purchases if the sale was completed for an employee
        AuthorizedPurchase::where('employee_id','=',$customer[0]->id)
                            ->where('status','=','pending')
                            ->update([
            'status' => "complete",
            'sales_date' => date("d-m-y")
        ]);

        // upload vehicle image
        $vehicleImage =  "image-".time().'.'.$request->vehicle_image->getClientOriginalExtension();
        $request->vehicle_image->move(public_path('images'), $vehicleImage);

        // upload pump image
        $pumpImage =  "image-".time().'.'.$request->pump_image->getClientOriginalExtension();
        $request->pump_image->move(public_path('images'), $pumpImage);

        // upload receipt image
        $receiptImage =  "image-".time().'.'.$request->receipt_image->getClientOriginalExtension();
        $request->receipt_image->move(public_path('images'), $receiptImage);

        //store sales details 
        Sale::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'vehicle_registration' => $data['vehicle_registration'],
            'product' => $data['product'],
            'rewards_used' => $data['used_rewards'],
            'rewards_awarded' => $data['rewards_awarded'],
            'amount_payable' => $data['amount_payable'],
            'amount_paid' => $data['amount_paid'],
            'image_url' => $vehicleImage,
            'pump_image_url' => $pumpImage,
            'receipt_image_url' => $receiptImage
        ]);


        
        //send a confirmation SMS 
        try {
            
            $this->sendSms($message,$receiverNumber);                              
            return  response()->json([
            'data' => $request->all(),
            ]);

        } catch (Exception $e) {

            return  response()->json([
                'data' => $e->getMessage(),
             ]);
        }
    }


     /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function addNewStaff(Request $request)
    {       
        
        // dd($request->all());

        //validate new staff details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'major_role' => ['required', 'string', 'max:255']  
         ]);
         
         $data = $request->all();

         User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Staff',
            'major_role' => ucfirst($data['major_role']),
            'phone_number' => '0719020100',
            'alternative_phone_number' => '0719020100',
            'address' => '00100',
            'town' => 'Nairobi',
            'krapin' => 'A010116927I',
            'logo_url' => 'IMG_URL'
        ]);


        session()->flash('success','Staff Added Successfully');
        return redirect()->back();

     
    }


     /**
     * add a new employee from cooperate dashboard
     *
     * @return "view"
     */
    public function addEmployee(Request $request)
    {      

        //validate eployee enrollment details
        $request->validate([
            'employee_firstname' => ['required', 'string', 'max:255'],
            'employee_lastname' => ['required', 'string', 'max:255'],
            'employee_gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => 'required|regex:(^07)|digits:10|unique:customers'          
         ]);

         $data = $request->all();


          //  create a new customer
          Customer::create([
            'first_name' => $data['employee_firstname'],
            'last_name' => $data['employee_lastname'],
            'gender' => $data['employee_gender'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'id_number' => $data['id_number'],
            'type' => Auth::user()->name,
            'rewards' => 0
        ]);

        session()->flash('success','Employee Added Successfully');
        return redirect()->back();
     
    }


     /**
     * delete a staff.
     *
     * @return "view"
     */
    public function deleteStaff(User $user)
    {          
        
        $user->delete();
        session()->flash('success','Staff Deleted Successfully');
        return redirect()->back();

    }  

     /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function showStaffs()
    {          
        if(Auth::user()->major_role == 'Admin')
        {
        $staffs = User::where('role','=','Staff')->get();
        return view('staff.users')->with(['staffs' => $staffs]);
        }
        else
        {
            return redirect('/choose-option');
        }
    }


    /**
     * get coorporate data for authorizing purchase
     *
     * @return "view"
     */
    public function getCoorporateData()
    {          
        
        $user = Auth::user()->name;
        $employees = Customer::where('type','=',$user)->get();
        $vehicles =  Vehicle::where('ownership','=', $user)->get();
        return response()->json([
            'employees' => $employees,
            'vehicles' => $vehicles
        ]);
     
    }


     /**
     * get coorporate employee data for editing
     *
     * @return "json"
     */
    public function getEmployeeData(Customer $customer)
    {          
        
        $employee_data  = Customer::where('id','=',$customer->id)->get();

        return response()->json([

            'employee' => $employee_data
        ]);
       
     
    }


    /**
     * get corporate employee dashboard data
     *
     * @return view
     */
    public function getDashboardData(Customer $customer)
    {          
        $user = Auth::user()->name;
        $employees = Customer::where('type','=',$user)->get();
        $vehicles =  Vehicle::where('ownership','=', $user)->get();
        $autorizedpurchases = AuthorizedPurchase::where('name','=', $user)->get();
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

         return view('cooperate-customer.dashboard')->with(['employees' => $employees,'vehicles' => $vehicles,'authorized_purchases' => $employees_authorized_data, 'company' => $company]);
       
       
     
    }


    /**
     * edit coorporate employee 
     * 
     * @return "view"
     */
    public function editEmployeeData(Request $request)
    {          
        
        $data = $request->all();

        //validate eployee enrollment details
        $request->validate([
            'edit_first_name' => ['required', 'string', 'max:255'],
            'edit_last_name' => ['required', 'string', 'max:255'],
            'edit_gender' => ['required', 'string', 'max:255'],
            'edit_email' => ['required', 'string', 'email', 'max:255'],
            'edit_phone_number' => 'required|regex:(^07)|digits:10',
            'edit_id_number' => 'required|min:7|max:8',
          
         ]);

         //update employee data using id 
         Customer::where('id','=',$data['employee_edit_id'])->update([
            'first_name' => $data['edit_first_name'],
            'last_name' => $data['edit_last_name'],
            'gender' => $data['edit_gender'],
            'email' => $data['edit_email'],
            'phone_number' => $data['edit_phone_number'],
            'id_number' => $data['edit_id_number']

         ]);


         session()->flash('success','Employee Edited Successfully');
         return redirect()->back();

    }



    /**
     * authorize fuel purchase
     *
     * 
     */
    public function authorizeFuelPurchase(Request $request)
    {          

        $data = $request->all();         
        $name = Auth::user()->name; 

        //check if the employee/vehicle is authorized and the status is pending 
        $alreadyAuthorizedVehicleandEmployees = AuthorizedPurchase::where(function($query) use ($data)
                    {
                        $query->where('employee_id','=',$data['employees']);
                        $query->orWhere('vehicle_id','=',$data['vehicles']);
                    })
                    ->where('status', '=', 'pending')->get();


        // if the employee/vehicle is already authorized cancel authorization
        if(count($alreadyAuthorizedVehicleandEmployees) > 0)
        { 
            session()->flash('success','The employee or the vehicle is already authorized try again once the sale is completed');
            return redirect()->back();  
        }
        else
        {
        
        //check payment type and compare amount
        if($data['payment_type'] == 'prepaid')
        {
            //check if amount to prepaid account is furnished
            $user = Auth::user()->id;
            $account = Account::where('organization_id','=',$user)
                    ->where('account_type','=','prepaid')
                    ->get();

            if(($account[0]->account_balance > $data['amount']) && ($account[0]->account_balance > 0))
            {   
                //create authorized purchase record for an employee
                AuthorizedPurchase::create([
                    'organization_id' => $user,
                    'employee_id' =>  $data['employees'],
                    'vehicle_id' =>  $data['vehicles'],
                    'amount' =>  $data['amount'],
                    'payment_type' =>  $data['payment_type'],
                    'status' => 'pending',
                    'name' => $name,
                    'organization_id' => $user
        
                ]);
        
                //update vehicle with customer id reward type and amount for the authorized purchase
                Vehicle::where('id','=', $data['vehicles'])->update([
                    'customer_id' => $data['employees'],
                ]);


                //update customer amount authrized and reward type to use
                Customer::where('id','=', $data['employees'])->update([
                    'authorized_amount' => $data['amount'],
                    'reward_type_to_use' => 'prepaid',
                ]);

                
                //update account balance for the corporate customer
                $new_account_balance = $account[0]->account_balance - $data['amount'];

                Account::where('organization_id','=',$user)
                        ->where('account_type','=','prepaid')
                        ->update([
                              'account_balance' => $new_account_balance
                             ]);

                session()->flash('success','Fuel Purchase Authorized Successfully');
                return redirect()->back();

            }
            else
            {

                session()->flash('success','You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                return redirect()->back();

            }

        }
        else
        {
         
            //check if amount to prepaid account is furnished
            $user = Auth::user()->id;
            $account = Account::where('organization_id','=',$user)
                    ->where('account_type','=','credit')
                    ->get();

            //get the account balance as a positive value
            $account_balance = abs($account[0]->account_balance);
            if(($account_balance > $data['amount']) && ($account_balance > 0 ))
            {
                AuthorizedPurchase::create([
                    'employee_id' =>  $data['employees'],
                    'vehicle_id' =>  $data['vehicles'],
                    'amount' =>  $data['amount'],
                    'payment_type' =>  $data['payment_type'],
                    'status' => 'pending',
                    'name' => $name,
                    'organization_id' => $user
        
                ]);
        
                //update vehicle with customer id
                Vehicle::where('id','=', $data['vehicles'])->update([
                    'customer_id' => $data['employees']
                ]);


                //update customer amount authrized and reward type to use
                Customer::where('id','=', $data['employees'])->update([
                    'authorized_amount' => $data['amount'],
                    'reward_type_to_use' => 'credit',
                ]);

                
                $new_account_balance = -1 * (abs($account[0]->account_balance) - $data['amount']);

                Account::where('organization_id','=',$user)
                        ->where('account_type','=','credit')
                        ->update([
                              'account_balance' => $new_account_balance
                             ]);

                session()->flash('success','Fuel Purchase Authorized Successfully');
                return redirect()->back();

            }
            else
            {

                session()->flash('success','You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                return redirect()->back();

            }


        }
  


        }
        
        
    }



     /**
     * get authorized fuel purchases
     *
     * 
     */
    public function getAuthorizedPurchases()
    {          

        $name = Auth::user()->name; 
        $id = Auth::user()->id; 
        $status = Account::where('organization_id','=',$id)
                          ->where('account_type','=','prepaid')
                          ->get()[0]->corporate_status;

        if($status == 'active')
        {
            $autorizedpurchases = AuthorizedPurchase::where('name','=',$name)->get();
            $employees_authorized_data = array();
    
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
    
             return view('cooperate-customer.authorizepurchase')->with(['authorized_purchases' => $employees_authorized_data]);
        

        }
        else
        {
            return redirect('/cooperate-customer-dashboard');

        }

         
    }


     /**
     * get authorized fuel purchases and show staff data
     *
     * 
     */
    public function getAuthorizedPurchasesForStaff()
    {    
        if(Auth::user()->major_role == 'Admin')
        {
            $autorizedpurchases = AuthorizedPurchase::all();
            $employees_authorized_data = array();
    
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
    
             return view('staff.authorized-purchases')->with(['authorized_purchases' => $employees_authorized_data]);
          

        }
        else
        {
            return redirect('/choose-option');
        }      

       
    }



    /**
     * add another vehicle.
     *
     * @return "view"
     */
    public function addAnotherVehicle(Request $request)
    {          
        $data = $request->all();

         //update customer vehicle image
         Vehicle::create([
            'customer_id' => $data['customer_id'],
            'vehicle_category' => $data['vehicle_category'],
            'vehicle_type' => $data['vehicle_type'],
            'vehicle_registration' => $data['vehicle_registration'],   
             ]);

        $vehicles = Vehicle::where('id','=',$data['customer_id'])->get();
        $customer = Customer::where('id','=',$data['customer_id'])->get();

        return response()->json([
            'customer' => $customer,
            'vehicles' => $vehicles
        ]);
      
     
    }

    /**
     * get all coorporate customer employees.
     *
     * @return "view"
     */
    public function getEmployees()
    {          
        
        $type = Auth::user()->name;
        $employees = Customer::where('type','=',$type)->get();
        return view('cooperate-customer.employees')->with(['employees' => $employees ]);
     
    }

    /**
     * get all dashboard data for the staff dashboard
     *
     * @return "view"
     */
    public function staffDashboard()
    {    
        if(Auth::user()->major_role == 'Admin')
        {  
        $customers = Customer::all();
        $sales = Sale::all();
        $autorizedpurchases = AuthorizedPurchase::all();
        $employees_authorized_data = array();

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
        
        return view('staff.dashboard')->with(['customers' => $customers, 'sales' => $sales , 'authorized_purchases' => $employees_authorized_data ]);
        
        }

        else
        {
            return redirect('/choose-option');
        }
    }


    /**
     * delete an employee.
     *
     * @return "view"
     */
    public function deleteEmployees(Customer $customer)
    {          
        
        //delete employee
        $customer->delete();

        //delete authorized purchases for the same employee
        AuthorizedPurchase::where('employee_id','=',$customer->id)->delete();

        session()->flash('success','Employee Deleted Successfully');
        return redirect()->back();
     
    }



     /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function showCustomers()
    {          
        if(Auth::user()->major_role == 'Admin')
        {

        $customers = Customer::all();
        return view('staff.customers')->with(['customers' => $customers]);
        }
        else
        {
            return redirect('/choose-option');
        }    
    }


     /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function deleteCustomer(Customer $customer)
    {          
        
        $customer->delete();
        session()->flash('success','Staff Deleted Successfully');
        return redirect()->back();
     
    }





    /**
     * ennroll a customer, send an SMS and redirect to chose option page.
     *
     * @return "view"
     */
    public function enrollCustomer(Request $request)
    {   

        $receiversNumber = "+254".substr($request->phone_number,1);
        $message = "Enrollment Completed successfully,you can now shop";

         //validate customer enrollment details
         $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => 'required|regex:(^07)|digits:10|unique:customers',
            'id_number' => 'required|min:7|max:8|unique:customers',
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'regno' => ['required', 'string', 'max:255'],
         ]);

         $data = $request->all();

        //  create a new customer
        $customer = Customer::create([
             'first_name' => $data['first_name'],
             'last_name' => $data['last_name'],
             'gender' => $data['gender'],
             'email' => $data['email'],
             'phone_number' => $data['phone_number'],
             'id_number' => $data['id_number'],
             'rewards' => 0
         ]);

        
        // upload vehicle image
        $fileName =  "image-".time().'.'.$request->vehicle_image->getClientOriginalExtension();
        $request->vehicle_image->move(public_path('images'), $fileName);


        //update customer vehicle image
        Vehicle::create([
        'customer_id' =>  $customer->id,
        'vehicle_category' => $data['category'],
        'vehicle_type' => $data['type'],
        'vehicle_registration' => $data['regno'],
        'image_url' => $fileName

         ]);


       //send a confirmation SMS 
       try{
        
            $this->sendSms($message, $receiversNumber);
            return  response()->json([
            'data' => $request->phone_number,
            ]);

        } 
        catch (Exception $e) {

            return  response()->json([
                'data' => $e->getMessage(),
            ]);
        }

   
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function edit(Request $request, Customer $customer)
    {
        //validate customer enrollment details
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => 'required|regex:(^07)|digits:10',
            'id_number' => 'required|min:7|max:8',
            'rewards' => 'integer'
    
         ]);
        
        
        $data = $request->all();


        //update customer data using id provided
        Customer::where('id','=',$data['id'])->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'id_number' => $data['id_number'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'rewards' => $data['rewards'],
        ]);

    
        return response()->json([

            'data' => 'success'
            
        ]);
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function editStaff(Request $request, User $user)
    {
        //validate customer enrollment details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'], 
            'major_role' =>  ['required', 'string', 'max:255'],
         ]);
        
        $data = $request->all();

        //update customer data using id provided
        User::where('id','=',$user->id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'major_role' => ucfirst($data['major_role'])
        ]);
    
        return response()->json([
            'data' => $data['name']
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function viewCustomerData(Customer $customer)
    {
        $customer_data = Customer::where('id',$customer->id)->get();

        return response()->json([
            
            'customer_data' => $customer_data
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function getStaffData(Request $request)
    {   
        $user = User::where('id','=',$request->all()['id'])->get();
        return response()->json([
            
            'user_data' => $user
        ]);
    }


    

   /**
     * Get customer data to be used in sales.
     *
     * @param  \App\Models\Request  $request
     * @return view with customer and vehicle data
     */
    public function getCustomerData(Request  $request)
    {           
         
         $data = $request->all();
         $vehicle = Vehicle::where('vehicle_registration','=',$string = str_replace(' ', '', $data['id_number']))->get();
        
         if(count($vehicle) > 0)
         {

            $customer = Customer::where('id','=',$vehicle[0]->customer_id)->get();
            $vehicles =  Vehicle::where('customer_id','=',$customer[0]->id )->get();

         }
         else
         {

            $customer = Customer::where('id_number','=',$data['id_number'])->orWhere('phone_number','=',$data['id_number'])->get();
            $vehicles =  Vehicle::where('customer_id','=',$customer[0]->id )->get();


         }

         return  response()->json([
            'customer' =>  $customer,
            'vehicles' =>  $vehicles
        ]);
      

    }


    
   /**
     * Get customer data to be used in sales.
     *
     * @param  \App\Models\Request  $request
     * @return view with customer and vehicle data
     */
    public function getCustomerSalesData(Request  $request)
    {           

         $data = $request->all();
         $customer = Customer::where('id','=',$data['customer_id'])->get();
         $vehicle =  Vehicle::where('id','=',$data['vehicle_id'])->get();

         return  response()->json([

            'customer' =>  $customer,
            'vehicle' =>   $vehicle
        ]);

    }

   

    /**
     * Remove the specified customer from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
