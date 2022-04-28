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



class CustomerController extends Controller
{

    public function getCompanyInfo()
    {   
        $user = Auth::user()->id;
        $company = User::where('id','=',$user)->get();
        return view('cooperate-customer.company-info')->with(['company' => $company]);

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
        AuthorizedPurchase::where('employee_id','=',$customer[0]->id)->update([
            'status' => "complete"
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
        //validate new staff details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
         ]);
         
         $data = $request->all();

         User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Staff'
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
            'phone_number' => 'required|regex:(^07)|digits:10|unique:customers',
            'id_number' => 'required|min:7|max:8|unique:customers',
          
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
        
        $staffs = User::where('role','=','Staff')->get();
        return view('staff.users')->with(['staffs' => $staffs]);
     
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

         return view('cooperate-customer.dashboard')->with(['employees' => $employees,'vehicles' => $vehicles,'authorized_purchases' => $employees_authorized_data]);
       
       
     
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
        
        AuthorizedPurchase::create([
            'employee_id' =>  $data['employees'],
            'vehicle_id' =>  $data['vehicles'],
            'amount' =>  $data['amount'],
            'payment_type' =>  $data['payment_type'],
            'receipt_number' =>  $data['receiptreg'],
            'status' => 'pending',
            'name' => $name

        ]);

        //update vehicle with customer id
        Vehicle::where('id','=', $data['vehicles'])->update([
            'customer_id' => $data['employees']
        ]);

        session()->flash('success','Fuel Purchase Authorized Successfully');
        return redirect()->back();
        
    }



     /**
     * get authorized fuel purchases
     *
     * 
     */
    public function getAuthorizedPurchases()
    {          

        $name = Auth::user()->name; 
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


     /**
     * get authorized fuel purchases and show staff data
     *
     * 
     */
    public function getAuthorizedPurchasesForStaff()
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
        
        $customers = Customer::all();
        return view('staff.customers')->with(['customers' => $customers]);
     
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
         ]);
        
        $data = $request->all();

        //update customer data using id provided
        User::where('id','=',$user->id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
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
         $customer = Customer::where('id_number','=',$data['id_number'])->orWhere('phone_number','=',$data['id_number'])->get();
         $vehicles =  Vehicle::where('customer_id','=',$customer[0]->id )->get();

         return  response()->json([

            'customer' =>  $customer,
            'vehicles' =>   $vehicles
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
