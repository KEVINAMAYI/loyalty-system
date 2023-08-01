<?php

namespace App\Http\Controllers;

use App\Models\OrganizationReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationRewardController extends Controller
{

    public function show(OrganizationReward $organization_reward)
    {
        if (Auth::user()->major_role == 'Admin') {
            return response()->json([
                'rewardformat' => $organization_reward
            ]);

        }

        return redirect()->back();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, OrganizationReward $organization_reward)
    {
        if (Auth::user()->major_role == 'Admin') {
            // validate customer enrollment details
            $request->validate([
                'reward_per_litre' => ['required'],
                'month' => ['required'],
                'reward_year' => ['required'],
            ]);

            $data = $request->all();

            $organization_reward->update([
                'shillings_per_litre' => $data['reward_per_litre'],
                'period' => $data['month'] . ' ' . $data['reward_year']
            ]);


            session()->flash('success', 'Organization Reward Updated Successfully');
        }

        return redirect()->back();
    }


}
