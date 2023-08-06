<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Reward;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class SaleController extends Controller
{
    /**
     *
     *
     * @return vkiew|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function makeSale()
    {

        $fuel_details = Products::all();
        return view('make-sale')->with(['fuel_details' => $fuel_details]);

    }


     /**
     *
     *
     * @return view
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
        if((Auth::user()->major_role == 'Admin'))
        {
            $sales  = Sale::orderBy('created_at','DESC')->get();
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
