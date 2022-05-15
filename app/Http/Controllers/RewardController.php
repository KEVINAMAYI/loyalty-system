<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\RewardFormat;
use Illuminate\Support\Facades\Auth;



class RewardController extends Controller
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRewardDetails()
    {   
        if(Auth::user()->major_role == 'Admin')
        {
            $products_details = Products::all();  
            $rewards_monthly = RewardFormat::where('reward_type','monthly')->get();  
            $rewards_bulk = RewardFormat::where('reward_type','bulk')->get();              
            return view('staff.rewards')->with(['products_details'=> $products_details, 'rewards_monthly' => $rewards_monthly, 'rewards_bulk' => $rewards_bulk ]);    
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
    public function setStatus(Request $request)
    {
        $data = $request->all();

        Reward::where('id','=',1)->update([
            'status' => $data['status']
        ]);

        return  response()->json([
            'data' => 'success',
         ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatus()
    {

        $reward = Reward::all();
        return  response()->json([
            'reward' => $reward,
         ]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setRewardPercentage(Request $request)
    {
        $data = $request->all();

        Reward::where('id','=',1)->update([
            'percentage' => ($data['reward_percentage'])
        ]);

        return  response()->json([
            'data' => 'success',
         ]);
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
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        //
    }
}
