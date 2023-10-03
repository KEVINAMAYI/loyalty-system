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
        if((Auth::user()->major_role == 'Admin') || (Auth::user()->major_role == 'Supervisor'))
        {
            $sales  = Sale::orderBy('created_at','DESC')->get();
            return view('staff.sales')->with(['sales' => $sales]);

        }
        else
        {
            return redirect('/choose-option');
        }


    }


}
