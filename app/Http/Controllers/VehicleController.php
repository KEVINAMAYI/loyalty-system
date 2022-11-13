<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\AuthorizedPurchase;
use Illuminate\Support\Facades\Auth;


class VehicleController extends Controller
{



    /**
     * Upload a corporate vehicle
     *
     * 
     */
    public function addCoorporateVehicle(Request $request)
    {   

        $data = $request->all();

         //update customer vehicle image
         Vehicle::create([
            'vehicle_category' => $data['vehicle_category'],
            'vehicle_type' => $data['vehicle_type'],
            'fuel_type' => $data['fuel_type'],
            'vehicle_registration' => $data['vehicle_registration'],   
            'ownership' => Auth::user()->name 
             ]);


        session()->flash('success','Vehicle Added Successfully');
        return redirect()->back();
       
                
    }



    /**
     * Store Vehicle Edited Data.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return
     */
    public function edit(Request $request, Vehicle $vehicle)
    {
        if(Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor')
        {
            //validate customer enrollment details
            $request->validate([
                'vehicle_category' => ['required', 'string', 'max:255'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'fuel_type' => ['required', 'string', 'max:255'],
                'vehicle_registration' => ['required', 'string', 'max:255']
            ]);


            $data = $request->all();

            //update customer data using id provided
            Vehicle::where('id','=',$data['id'])->update([
                'vehicle_category' => $data['vehicle_category'],
                'vehicle_type' => $data['vehicle_type'],
                'fuel_type' => $data['fuel_type'],
                'vehicle_registration' => $data['vehicle_registration'],
            ]);


            return response()->json([

                'data' => 'success'

            ]);

        }
        else
        {
            return redirect('/choose-option');
        }
       
    }
    
    /**
     * get all corporate vehicles
     *
     * 
     */
    public function getCoorporateVehicle()
    {   

         $user = Auth::user()->name;

         //update customer vehicle image
         $vehicles = Vehicle::where('ownership','=', $user)->get();
         return view('cooperate-customer.vehicles')->with(['vehicles' => $vehicles]);
       
                
    }


   /**
     * get specific vehicle data
     *
     * 
     */
    public function getVehicleData(Vehicle $vehicle)
    {   

         //update customer vehicle image
         $vehicle_data = Vehicle::where('id','=', $vehicle->id)->get();
         return response()->json([
             'vehicle' => $vehicle_data
         ]);
       
                
    }


     /**
     * get specific vehicle data
     *
     * 
     */
    public function editVehicleData(Request $request)
    {   

        $data = $request->all();

         //update customer vehicle image
         Vehicle::where('id','=',$data['vehicle_edit_id'])->update([
            'vehicle_category' => $data['edit_vehicle_category'],
            'vehicle_type' => $data['edit_vehicle_type'],
            'fuel_type' => $data['edit_fuel_type'],
            'vehicle_registration' => $data['edit_vehicle_registration'],   
             ]);


        session()->flash('success','Vehicle Edited Successfully');
        return redirect()->back();

                
    }


    /**
     * Delete a corporate vehicle
     *
     * 
     */
    public function deleteCoorporateVehicle(Vehicle $vehicle)
    {   

        //update customer vehicle image
        $vehicle->delete();

        //delete authorized purchases for the same vehicle
        AuthorizedPurchase::where('vehicle_id','=',$vehicle->id)->delete();

        session()->flash('success','Vehicle Deleted Successfully');
        return redirect()->back();       
                
    }


    /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function showVehicles()
    {
        if(Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor')
        {

           $vehicles = Vehicle::all();
           return view('staff.vehicles')->with(['vehicles' => $vehicles]);

        }
        else
        {
             return redirect('/choose-option');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $customer
     * @return
     */
    public function viewVehicleData(Vehicle $vehicle)
    {
        $vehicles_data = Vehicle::where('id','=',$vehicle->id)->get();

        return response()->json([
            'vehicle_data' => $vehicles_data
        ]);
    }

    
}
