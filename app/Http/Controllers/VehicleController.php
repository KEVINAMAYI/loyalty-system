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
            'vehicle_registration' => $data['vehicle_registration'],   
            'ownership' => Auth::user()->name 
             ]);


        session()->flash('success','Vehicle Added Successfully');
        return redirect()->back();
       
                
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
