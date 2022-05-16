<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\AuthorizedPurchase;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{

    public function getAccountData()
    {

        $user = Auth::user()->id;
        $name = Auth::user()->name;
        $autorizedpurchases = AuthorizedPurchase::where('name','=',$name)
                                                 ->where('status','=','complete')
                                                 ->get();
        $employees_authorized_data = array();

        //get authorized purchases data for displying sales
        foreach ($autorizedpurchases as $autorizedpurchase)
        {
            $customerid = $autorizedpurchase->employee_id;
            $vehicleid = $autorizedpurchase->vehicle_id;
            $personal_data = Customer::where('id','=',$customerid)->get();
            $vehicle_data = Vehicle::where('id','=',$vehicleid)->get();


            $employee = array();

            array_push($employee, $personal_data);
            array_push($employee, $vehicle_data);
            array_push($employee,  $autorizedpurchase);
            array_push($employees_authorized_data,$employee);

        }


        $accounts = Account::where('organization_id','=',$user)->get();
        $payments = Payment::where('organization_id','=',$user)->get();
        return view('cooperate-customer.account')->with(['accounts' => $accounts, 'payments' => $payments, 'authorized_purchases' => $employees_authorized_data ]);


    }

    // set credit limit for a specific corporate
    public function setCreditLimit(Request $request)
    {

         // validate credit limit details enrollment details
         $request->validate([
            'account_number' => ['required'],
            'account_limit' => ['required'],
            'discount' => ['required'],
            'corporate_status' => ['required']

         ]);

         $data = $request->all();

         //get amount_payable and add to the new limit set
         $account = Account::where('organization_id', $data['corporate_id'])->get();
         $amount_payable = $account[0]->amount_payable + $data['account_limit'];

         Account::where('organization_id', $data['corporate_id'])->update([
             'organization_id' => $data['corporate_id'],
             'account_number' => $data['account_number'],
             'account_limit' => $data['account_limit'],
             'account_balance' => $data['account_limit'],
             'limit_utilized' => 0,
             'discount' => $data['discount'],
             'account_type' => $data['account_type'],
             'amount_payable' => $amount_payable,
             'corporate_status' => $data['corporate_status']
         ]);

         session()->flash('success','The Account Limit set Successfully');
         return redirect()->back();

    }


    //make payment or purchase 
    public function makePaymentOrPurchases(Request $request)
    {

        // dd($request->all());
        $data = $request->all();
        

        // if credit payment offset the bill otherwise add to the prepay account
        if($data['account_type'] == 'credit')
        {
            //account balance account debt + amount paid
            $account = Account::where('organization_id','=',$data['corporate_id'])->where('account_type','=','credit')->get();
            $new_account_balance = ($account[0]->amount_payable + $data['amount_paid']);
            Account::where('id','=',$account[0]->id)->update([
                'amount_payable' => $new_account_balance
            ]);
        }
        else
        {
            //account balance account balance + amount paid
            $account = Account::where('organization_id','=',$data['corporate_id'])->where('account_type','=','prepaid')->get();
            $new_account_balance = ($account[0]->account_balance + $data['amount_paid']);
            Account::where('id','=',$account[0]->id)->update([
                'account_balance' => $new_account_balance
            ]);

            
        }

        //create a payment record
        Payment::create([
            'payed_by' => $data['corporate_id'],
            'amount_paid' => $data['amount_paid'],
            'reference_number' => $data['reference_number'],
            'payment_mode' => $data['payment_mode'],
            'payment_date' => $data['payment_date'],
            'payment_status' => 'received',
            'organization_id' => $data['corporate_id'],
            'account_type' => $data['account_type']
        ]);

        session()->flash('success','The Payment was successful');
        return redirect()->back();

    }


}