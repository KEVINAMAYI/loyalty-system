<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Twilio\Rest\Client;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    

    public function sendConfirmationSMS(Request $request)
    {

        
        $receiverNumber = "+254".substr($request->phone_number,1);
        $message = "Sales Completes successfully, Thanks and shop with us again";
        $data = $request->all();

        Customer::where('id_number','=',$data['customer_id'])->update([
            'rewards' => $data['new_cutomer_rewards']
        ]);

        //store sales details 
        Sale::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'vehicle_registration' => $data['vehicle_registration'],
            'product' => $data['product'],
            'rewards_used' => $data['used_rewards'],
            'amount_payable' => $data['amount_payable'],
            'amount_paid' => $data['amount_paid']
        ]);
        
        //send a confirmation SMS 
        try {
            
            $twilio = new Client("AC8c2b5689cdba26cc2f64572c6af30c54", "174622fda8c3e01753fede3ca61a77e6");             
            $message = $twilio->messages->create( $receiverNumber, // to 
                                                    array(  
                                                        "messagingServiceSid" => "MGa35420a48487485b2f663daf4a7e9033",      
                                                        "body" => $message 
                                                    ) 
                                                 ); 
        return  response()->json([
           'data' => 'success',
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
     * delet a staff.
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
     * ennroll a customer and redirect to chose option page.
     *
     * @return "view"
     */
    public function enrollCustomer(Request $request)
    {   

         //validate customer enrollment details
         $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => 'required|regex:(^07)|digits:10',
            'id_number' => 'required|min:7|max:8',
            'category' => ['required', 'string', 'max:255'],
            'regno' => ['required', 'string', 'max:255'],
         ]);

         $data = $request->all();


         //create a new customer
         Customer::create([
             'first_name' => $data['first_name'],
             'last_name' => $data['last_name'],
             'gender' => $data['gender'],
             'email' => $data['email'],
             'phone_number' => $data['phone_number'],
             'id_number' => $data['id_number'],
             'rewards' => 0
         ]);

        
        //upload vehicle image
        $fileName =  "image-".time().'.'.$request->vehicle_image->getClientOriginalExtension();
        $request->vehicle_image->move(public_path('images'), $fileName);


        //update customer vehicle image
        Vehicle::create([
        'customer_id' =>  1,
        'vehicle_category' => $data['category'],
        'vehicle_registration' => $data['regno'],
        'image_url' => $fileName

         ]);

        return  response()->json([
            'data' => $data,
        ]);


   
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function edit(Customer $customer)
    {
        //
    }


   /**
     * Get customer data to be used in sales.
     *
     * @param  \App\Models\Request  $request
     * @return view with customer and vehicle data
     */
    public function getCustomerData(Request  $request)
    {
         //validate customer id and vehicle number details
         $request->validate([
            'id_number' => 'min:7|max:8',
            'vehicle_reg' => ['string', 'max:255'],
         ]);

         $data = $request->all();
         $customer = Customer::where('id_number','=',$data['id_number'])->get();
         $vehicle =  Vehicle::where('vehicle_registration','=',$data['vehicle_reg'])->get();

         return  response()->json([

            'customer' =>  $customer,
            'vehicle' =>   $vehicle
        ]);

    }

    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return 
     */
    public function update(Request $request, Customer $customer)
    {
        //
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
