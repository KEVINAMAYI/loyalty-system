<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Reward;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    /**
     * 
     *
     * @return vkiew
     */
    public function makeSale()
    {   

        $fuel_details = Products::all();        
        $reward_details = Reward::all();
        return view('make-sale')->with(['rewards_details' => $reward_details,'fuel_details' => $fuel_details]);

    }


     /**
     * 
     *
     * @return vkiew
     */
    public function getSaleData(Sale $sale)
    {   

        $sale_data = $sale->where('id','=',$sale->id)->get();

        return  response()->json([
            'sale_data' => $sale_data,
            ]);

    }


    /**
     * Get all sales from the database.
     *
     * @return view
     */
    public function getSales()
    {
        if((Auth::user()->major_role == 'Admin') || (Auth::user()->major_role == 'Supervisor'))
        {
            $sales = Sale::all()->sortByDesc("id");
            // dd($sales);

            return view('staff.sales')->with(['sales' => $sales]);
        }
        else
        {
            return redirect('/choose-option');
        }
        

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
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
