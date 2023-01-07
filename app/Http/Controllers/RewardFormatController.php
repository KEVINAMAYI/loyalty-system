<?php

namespace App\Http\Controllers;

use App\Models\RewardFormat;
use Illuminate\Http\Request;

class RewardFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRewardFormat($product_type)
    {
        $rewards_format = RewardFormat::where('product_type',$product_type)->get();
        return response()->json([
            'rewards_format' => $rewards_format
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMonthlyreward(Request $request)
    {
         // validate customer enrollment details
         $request->validate([
            'lower_range' => ['required'],
            'higher_range' => ['required'],
            'reward_per_litre' =>['required'],
            'month' => ['required'],
            'reward_year' => ['required'],

         ]);

         $data = $request->all();

         RewardFormat::where('id',$data['monthly_reward_id'])->update([
             'low' => $data['lower_range'],
             'high' => $data['higher_range'],
             'shillings_per_litre' => $data['reward_per_litre'],
             'price_period' => $data['month'].' '.$data['reward_year']

         ]);


        session()->flash('success','Monthly Reward Updated Successfully');
        return redirect()->back();
    }

    public function editBulkreward(Request $request)
    {
         // validate customer enrollment details
         $request->validate([
            'lower_range' => ['required'],
            'higher_range' => ['required'],
            'reward_per_litre' =>['required'],
            'month' => ['required'],
            'reward_year' => ['required'],

         ]);

         $data = $request->all();

         RewardFormat::where('id',$data['bulk_reward_id'])->update([
             'low' => $data['lower_range'],
             'high' => $data['higher_range'],
             'shillings_per_litre' => $data['reward_per_litre'],
             'price_period' => $data['month'].' '.$data['reward_year']

         ]);


        session()->flash('success','Bulk Reward Updated Successfully');
        return redirect()->back();
    }


    public function getSingleRewardFormat(RewardFormat $rewardFormat)
    {

        $rewardformat = RewardFormat::where('id',$rewardFormat->id)->get();
        return response()->json([

            'rewardformat' => $rewardformat
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RewardFormat  $rewardFormat
     * @return \Illuminate\Http\Response
     */
    public function show(RewardFormat $rewardFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RewardFormat  $rewardFormat
     * @return \Illuminate\Http\Response
     */
    public function edit(RewardFormat $rewardFormat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardFormat  $rewardFormat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardFormat $rewardFormat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RewardFormat  $rewardFormat
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardFormat $rewardFormat)
    {
        //
    }
}
