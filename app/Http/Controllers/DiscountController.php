<?php

namespace App\Http\Controllers;

use App\Models\AutomaticDiscount;
use App\Models\Customer;
use App\Models\Vehicle;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Stevebauman\Location\Facades\Location;

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
        $customer_rewards = Customer::where('id', $data['customer_id'])->get()[0]->rewards;

        if ($customer_rewards >= $data['discount']) {
            $ip = "$request->ip()";
            $position = Location::get($ip);
            $country = $position->countryName;
            $city = $position->cityName;
            $zipCode = $position->zipCode;
            $latitude = $position->latitude;
            $longitude = $position->longitude;

            Discount::create([
                'customer_id' => $data['customer_id'],
                'amount' => $data['discount'],
                'status' => 'pending',
                'csa' => $data['csa'],
                'pump' => $data['pump_reward'],
                'pump_side' => $data['pump_side_reward'],
                'redeemed_by' => Auth::user()->name,
                'country' => $country ?? 'Kenya',
                'city' => $city ?? 'Nairobi',
                'zipCode' => $zipCode ?? '00100',
                'latitude' => $latitude ?? '-1.2814',
                'longitude' => $longitude ?? '36.905',
            ]);

            return response()->json([
                'code' => 'Success',
                'message' => 'Discount Redemption has been set successfully, Wait for approval from Admin to complete the process'
            ]);
        } else {

            return response()->json([
                'code' => 'Error',
                'message' => 'Discount must be greater than customer rewards'
            ]);
        }


    }

    public function setDiscountStatus(Request $request): \Illuminate\Http\JsonResponse
    {

        $approved_date = Carbon\Carbon::now();
        $data = $request->all();
        Discount::where('id', $data['discount_id'])->update(
                 ['status' => 'approved',
                'approver' => Auth::user()->name,
                'approved_date' =>$approved_date->toDateTimeString()]);
        $discount = Discount::where('id', $data['discount_id'])->get()[0];
        $customer_id = $discount->customer_id;
        $amount = $discount->amount;
        Customer::find($customer_id)->decrement('rewards', $amount);

        return response()->json([
            'message' => 'success'
        ]);

    }

    public function getDiscounts()
    {

        $discounts = Discount::with('customer')->orderBy('id','desc')->get();
        $automatic_discount_data = AutomaticDiscount::orderBy('discount_number','desc')->get();
        return view('staff.discounts', compact('discounts','automatic_discount_data'));
    }

    public function getAutomaticDiscounts()
    {

        $automatic_discount_data = AutomaticDiscount::orderBy('discount_number','desc')->get();
        return view('staff.automatic_discounts', compact('automatic_discount_data'));
    }

    public function updatePrintState($discount): \Illuminate\Http\JsonResponse
    {
        $approved_date = Carbon\Carbon::now();
        Discount::where('id', $discount)->update([
            'printed' => 'Completed',
            'approved_date' => $approved_date->toDateTimeString()
        ]);
        return \response()->json(['printed' => $discount]);
    }

    public function updateAutomaticPrintState($discount): \Illuminate\Http\JsonResponse
    {
        AutomaticDiscount::where('discount_number', $discount)->update([
            'printed' => 'Completed',
        ]);
        return \response()->json(['printed' => $discount]);
    }


    public function loadDiscountPDF($discountId)
    {
        $discount = Discount::with('customer')->where('id', $discountId)->get()[0];
        $customer = $discount->customer;
        return view('staff.discount_pdf_template', compact('discount', 'customer'));

    }

    public function loadAutomaticDiscountPDF($discountId)
    {
        $discount = AutomaticDiscount::where('discount_number', $discountId)->get()[0];
        return view('staff.automatic_discount_pdf_template', compact('discount'));

    }

}
