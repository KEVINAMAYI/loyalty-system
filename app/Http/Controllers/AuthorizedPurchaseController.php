<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AuthorizedPurchase;


class AuthorizedPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\AuthorizedPurchase  $authorizedPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(AuthorizedPurchase $authorizedPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthorizedPurchase  $authorizedPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthorizedPurchase $authorizedPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthorizedPurchase  $authorizedPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthorizedPurchase $authorizedPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthorizedPurchase  $authorizedPurchase
     * @return \Illuminate\Http\Response
     */
    public function deleteAuthorizeFuelPurchase(AuthorizedPurchase $authorizedPurchase)
    {
        
        $authorizedPurchase_record = AuthorizedPurchase::where('id','=',$authorizedPurchase->id)->get();
        $user = $authorizedPurchase_record[0]->organization_id;
        $amount = $authorizedPurchase_record[0]->amount; 
        $payment_type = $authorizedPurchase_record[0]->payment_type; 
        $status = $authorizedPurchase_record[0]->status; 

        //update corporate account only when the status is pending.
        if($status == 'pending')
        {

             //get account for the organization that authorized the purchase
            $account = Account::where('organization_id','=',$user)
                                ->where('account_type','=',$payment_type)
                                ->get();

            //update account balance
            $new_account_balance = -1 * (abs($account[0]->account_balance) + $amount);
            Account::where('organization_id','=',$user)
            ->where('account_type','=',$payment_type)
            ->update(['account_balance' => $new_account_balance]);

            //delete the authorized purchase record and return a success message
            $authorizedPurchase->delete();
            session()->flash('success','Authorized Purchase Deleted Successfully');
            return redirect()->back();

        }
        else
        {

             //delete the authorized purchase record and return a success message
             $authorizedPurchase->delete();
             session()->flash('success','Authorized Purchase Deleted Successfully');
             return redirect()->back();


        }

       

        
    }
}
