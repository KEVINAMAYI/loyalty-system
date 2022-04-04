<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    

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
