<?php

namespace App\Http\Controllers;
use App\Models\OrganizationReward;
use Illuminate\Http\Request;

class OrganizationRewardController extends Controller
{

 public function show(OrganizationReward $organization_reward){

     return response()->json([
         'rewardformat' => $organization_reward
     ]);

 }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,OrganizationReward $organization_reward)
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

        $organization_reward->update([
            'low' => $data['lower_range'],
            'high' => $data['higher_range'],
            'shillings_per_litre' => $data['reward_per_litre'],
            'period' => $data['month'].' '.$data['reward_year']
        ]);


        session()->flash('success','Organization Reward Updated Successfully');
        return redirect()->back();
    }


}
