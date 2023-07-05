<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Customer;
use App\Models\Organization;
use App\Models\OrganizationReward;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('staff.organizations', compact('organizations'));
    }

    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create($request->validated());
        $this->storeDefaultOrganizationRewards($organization);
        session()->flash('success', 'Organization created successfully');
        return redirect()->back();
    }

    public function show(Organization $organization){
        return response()->json([
           'organization' => $organization
        ]);
    }

    public function destroy(Organization $organization)
    {

        $organization->delete();
        session()->flash('success', 'Organization created successfully');
        return redirect()->back();

    }

    public function update(UpdateOrganizationRequest $request, Organization $organization){
        $organization->update($request->validated());
        session()->flash('success', 'Organization updated successfully');
        return redirect()->back();
    }

    public function editOrganizationRewards(Organization  $organization){

        $petrol_reward_formats = OrganizationReward::where('organization_id',$organization->id)
                                                    ->where('product_type','petrol')->get();
        $diesel_reward_formats = OrganizationReward::where('organization_id',$organization->id)
                                                     ->where('product_type','diesel')->get();;
        return view('staff.organizational_rewards',compact('organization','petrol_reward_formats','diesel_reward_formats'));
    }


    private function storeDefaultOrganizationRewards(Organization  $organization)
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
                'low' => 101,
                'high' => 250,
                'reward_type' => 'organization',
                'shillings_per_litre' => 1.69,
                'period' => 'July 2023',
                'product_type' => 'Petrol'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 251,
                'high' => 500,
                'reward_type' => 'organization',
                'shillings_per_litre' => 1.69,
                'period' => 'July 2023',
                'product_type' => 'Petrol'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 501,
                'high' => 1000,
                'reward_type' => 'organization',
                'shillings_per_litre' => 1.69,
                'period' => 'July 2023',
                'product_type' => 'Petrol'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 1000,
                'high' => 1000000,
                'reward_type' => 'organization',
                'shillings_per_litre' => 1.69,
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
            ],
            [
                'organization_id' => $organization->id,
                'low' => 101,
                'high' => 250,
                'reward_type' => 'organization',
                'shillings_per_litre' => 2,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 251,
                'high' => 500,
                'reward_type' => 'organization',
                'shillings_per_litre' => 2,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 501,
                'high' => 1000,
                'reward_type' => 'organization',
                'shillings_per_litre' => 2,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ],
            [
                'organization_id' => $organization->id,
                'low' => 1000,
                'high' => 1000000,
                'reward_type' => 'organization',
                'shillings_per_litre' => 2,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ]


        ]);
    }

}
