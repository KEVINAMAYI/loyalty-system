<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DiscountController extends Controller
{

    /**
     * Get all sales from the database.
     *
     *
     */
    public function getCustomers()
    {
        if ((Auth::user()->major_role == 'Admin') || (Auth::user()->major_role == 'Supervisor')) {
            $customers = Customer::with('discounts')->get();
            return view('staff.redeem_discounts')->with(['customers' => $customers]);

        } else {
            return redirect('/choose-option');
        }


    }


    public function getDiscountData(Customer $customer)
    {
        $customer_data = Customer::where('id', $customer->id)->get();
        $discount_data = Discount::where('customer_id', $customer->id)->where('status', 'pending')->get();
        $vehicles_data = Vehicle::where('customer_id', '=', $customer->id)->get();

        return response()->json([
            'customer_data' => $customer_data,
            'vehicles_data' => $vehicles_data,
            'discount_data' => $discount_data
        ]);
    }


    public function setDiscount(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        $customer_rewards = Customer::where('id',$data['customer_id'])->get()[0]->rewards;

        if($customer_rewards >= $data['discount'])
        {
            Discount::create([
                'customer_id' => $data['customer_id'],
                'amount' => $data['discount'],
                'status' => 'pending',
                'redeemed_by' => Auth::user()->name
            ]);

            return response()->json([
                'code' => 'Success',
                'message' => 'Discount Redemption has been set successfully, Wait for approval from Admin to complete the process'
            ]);
        }
        else{

            return response()->json([
                'code' => 'Error',
                'message' => 'Discount must be greater than customer rewards'
            ]);
        }



    }

    public function setDiscountStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        Discount::where('id', $data['discount_id'])->update(['status' => 'approved']);
        $discount = Discount::where('id', $data['discount_id'])->get()[0];
        $customer_id = $discount->customer_id;
        $amount = $discount->amount;
        Customer::find($customer_id)->decrement('rewards',$amount);

        return response()->json([
            'message' => 'success'
        ]);

    }

    public function getDiscounts()
    {

        $discounts = Discount::with('customer')->get();
        return view('staff.discounts', compact('discounts'));
    }


    public function loadDiscountPDF($discountId)
    {
        $discount = Discount::with('customer')->where('id',$discountId)->get()[0];
        $customer = $discount->customer;
        return view('staff.discount_pdf_template',compact('discount','customer'));

    }

}
