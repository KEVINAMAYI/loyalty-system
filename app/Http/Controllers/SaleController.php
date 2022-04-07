<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Reward;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * 
     *
     * @return vkiew
     */
    public function makeSale()
    {   

        $reward_details = Reward::all();
        return view('make-sale')->with(['rewards_details' => $reward_details]);

    }


    /**
     * Get all sales from the database.
     *
     * @return view
     */
    public function getSales()
    {
        $sales = Sale::all();
        return view('staff.sales')->with(['sales' => $sales]);

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
