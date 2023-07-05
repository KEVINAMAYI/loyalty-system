<?php

namespace App\Http\Controllers;

use App\Models\customerReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRewardController extends Controller
{
    public function show(CustomerReward $customer_reward)
    {
        if (Auth::user()->major_role == 'Admin') {
            return response()->json([
                'rewardformat' => $customer_reward
            ]);
        }

        return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CustomerReward $customer_reward)
    {
        if (Auth::user()->major_role == 'Admin') {

            // validate customer enrollment details
            $request->validate([
                'lower_range' => ['required'],
                'higher_range' => ['required'],
                'reward_per_litre' => ['required'],
                'month' => ['required'],
                'reward_year' => ['required'],
            ]);

            $data = $request->all();

            $customer_reward->update([
                'low' => $data['lower_range'],
                'high' => $data['higher_range'],
                'shillings_per_litre' => $data['reward_per_litre'],
                'period' => $data['month'] . ' ' . $data['reward_year']
            ]);

            session()->flash('success', 'Customer Reward Updated Successfully');
        }

        return redirect()->back();
    }
}
