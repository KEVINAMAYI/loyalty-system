<?php

namespace App\Http\Controllers;

use App\Models\AuthorizedPurchase;
use Illuminate\Http\Request;

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

        $authorizedPurchase->delete();
        
        session()->flash('success','Authorized Purchase Deleted Successfully');
        return redirect()->back();

        
    }
}
