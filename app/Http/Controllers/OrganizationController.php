<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Customer;
use App\Models\Organization;
use App\Models\OrganizationReward;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function index()
    {
        if (Auth::user()->major_role == 'Admin') {
            $organizations = Organization::all();
            return view('staff.organizations', compact('organizations'));
        }
        return redirect()->back();
    }

    public function store(StoreOrganizationRequest $request)
    {
        if (Auth::user()->major_role == 'Admin') {
            $organization = Organization::create($request->validated());
            $this->storeDefaultOrganizationRewards($organization);
            session()->flash('success', 'Organization created successfully');
        }
        return redirect()->back();
    }

    public function show(Organization $organization)
    {
        if (Auth::user()->major_role == 'Admin') {
            return response()->json([
                'organization' => $organization
            ]);
        }
    }

    public function destroy(Organization $organization)
    {
        if (Auth::user()->major_role == 'Admin') {
            $organization->delete();
            session()->flash('success', 'Organization created successfully');
        }
        return redirect()->back();
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        if (Auth::user()->major_role == 'Admin') {
            $organization->update($request->validated());
            session()->flash('success', 'Organization updated successfully');
        }
        return redirect()->back();
    }

    public function editOrganizationRewards(Organization $organization)
    {
        if (Auth::user()->major_role == 'Admin') {

            $petrol_reward_formats = OrganizationReward::where('organization_id', $organization->id)
                ->where('product_type', 'petrol')->get();
            $diesel_reward_formats = OrganizationReward::where('organization_id', $organization->id)
                ->where('product_type', 'diesel')->get();;
            return view('staff.organizational_rewards', compact('organization', 'petrol_reward_formats', 'diesel_reward_formats'));
        }
        return redirect()->back();
    }


    public function getOrganizationSales($organization_id)
    {
        $sales = Sale::where('organization_id', $organization_id)->orderBy('created_at', 'DESC')->get();
        $litres_sold = $sales->sum('litres_sold');
        $amount_paid = $sales->sum('amount_paid');
        $reward_sum = $sales->sum('rewards_awarded');
        $bulk_reward_sum = $sales->sum('bulk_rewards');
        return view('staff.organization_sales', compact('sales','reward_sum','bulk_reward_sum','litres_sold','amount_paid'));
    }


    private function storeDefaultOrganizationRewards(Organization $organization)
    {

        DB::table('organization_rewards')->insert([
            [
                'organization_id' => $organization->id,
                'low' => 0,
                'high' => 100,
                'reward_type' => 'organization',
                'shillings_per_litre' => 0.69,
                'period' => 'July 2023',
                'product_type' => 'Petrol'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 0,
                'high' => 100,
                'reward_type' => 'organization',
                'shillings_per_litre' => 1,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ]
        ]);
    }

}
