<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Products;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\RewardFormat;
use Illuminate\Support\Facades\Auth;


class RewardController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function getRewardDetails()
    {
        if (Auth::user()->major_role == 'Admin') {
            $products_details = Products::all();

            //Petrol Rewards
            $petrol_monthly_rewards = RewardFormat::where('reward_type', 'monthly')->where('product_type', 'Petrol')->get();
            $petrol_bulk_rewards = RewardFormat::where('reward_type', 'bulk')->where('product_type', 'Petrol')->get();
            $petrol_credits_rewards = RewardFormat::where('reward_type', 'credit')->where('product_type', 'Petrol')->get();
            $petrol_prepaid_rewards = RewardFormat::where('reward_type', 'prepaid')->where('product_type', 'Petrol')->get();

            //Diesel Rewards
            $diesel_monthly_rewards = RewardFormat::where('reward_type', 'monthly')->where('product_type', 'Diesel')->get();
            $diesel_bulk_rewards = RewardFormat::where('reward_type', 'bulk')->where('product_type', 'Diesel')->get();
            $diesel_credits_rewards = RewardFormat::where('reward_type', 'credit')->where('product_type', 'Diesel')->get();
            $diesel_prepaid_rewards = RewardFormat::where('reward_type', 'prepaid')->where('product_type', 'Diesel')->get();


            return view('staff.rewards')->with(
                [
                    'products_details' => $products_details,
                    'petrol_monthly_rewards' => $petrol_monthly_rewards,
                    'petrol_bulk_rewards' => $petrol_bulk_rewards,
                    'petrol_credits_rewards' => $petrol_credits_rewards,
                    'petrol_prepaid_rewards' => $petrol_prepaid_rewards,
                    'diesel_monthly_rewards' => $diesel_monthly_rewards,
                    'diesel_bulk_rewards' => $diesel_bulk_rewards,
                    'diesel_credits_rewards' => $diesel_credits_rewards,
                    'diesel_prepaid_rewards' => $diesel_prepaid_rewards
                ]);
        } else {
            return redirect('/choose-option');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setStatus(Request $request)
    {
        $data = $request->all();
        Status::where('reward_type',$data['reward_type'])->update([
            'status' => $data['status']
        ]);

        return response()->json([
            'data' => 'success',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus()
    {

        $organization_reward_status = Status::where('reward_type','organization')->first();
        $customer_reward_status = Status::where('reward_type','customer')->first();
        $bulk_reward_status = Status::where('reward_type','bulk')->first();

        return response()->json([
            'organization_reward_status' => $organization_reward_status,
            'customer_reward_status' => $customer_reward_status,
            'bulk_reward_status' => $bulk_reward_status,
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

        Reward::where('id', '=', 1)->update([
            'percentage' => ($data['reward_percentage'])
        ]);

        return response()->json([
            'data' => 'success',
        ]);
    }


}
