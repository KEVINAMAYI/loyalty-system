@extends('staff.layouts.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Discount Redemption</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">


        {{-- display success message on a successful action --}}
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        {{-- display error on top of the form --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error )
                        <li class="list-group-item">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 row">
                            <div class="col-md-10">
                                <h6>Discount Redemption</h6>
                            </div>
                            <div class="col-md-2">
                                {{-- <a class="btn btn-primary text-right" style="background-color:#f9a14d;" href="/sales">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    Back</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
                        <div class="table-responsive p-0">
                            <table data-ordering="false" id="customer_discount_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Name</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Phone</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Vehicle</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Rewards Available</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Product</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ( $customers as $customer )
                                    <tr>
                                        <td class="text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $customer->first_name.' '.$customer->second_name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $customer->phone_number }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') != null ? App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') : 'No Vehicle Assigned' }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $customer->rewards }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('fuel_type') != null ? App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('fuel_type') : 'No Vehicle Assigned' }}</span>
                                        </td>
                                        @if($id = $customer->discounts()->where('status','pending')->first())
                                            <td class="text-sm">
                                                <button  id="{{ $customer->id }}"   class="discount-pending-btn btn btn-sm btn-info" >pending</button>
                                            </td>
                                        @else
                                            <td class="text-sm">
                                                <button  id="{{ $customer->id }}" discount_id="{{ $id }}"  class="discount-details btn btn-sm btn-warning" >redeem</button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Name</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Phone</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Vehicle</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Rewards Available</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Product</th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--  GET specific sale details modal More Info-->
    <!-- Modal -->
    <div class="modal fade" id="discount-details-modal" tabindex="-1" aria-labelledby="sales-details" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Discount Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-holder form-holder-2 mb-2">
                        <label for="name">Customer</label></br>
                        <p id="name" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="vehiclereg">Vehicle Registration & Product</label></br>
                        <p  id="vehiclereg" style="padding-left:5px;"></p>
                    </div>

                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="rewards">Rewards (Total Rewards, Rewards Available)</label></br>
                        <p id="rewards" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <div class="row">
                            <div class="col-6">
                                <label for="Discount">Enter Rewards To Redeem</label></br>
                            </div>
                            <div class="col-6">
                                <input
                                    style="width:90%; margin-right:10%; margin-left:-70px; padding:5px;  border-color: black; border-width:1px; "
                                    type="number" name="discount" id="discount" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="customer_id" name="customer_id" value="">
                        <button type="button"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button id="set_discount_btn" style="margin-left:60%;"   type="button" class="btn  btn-secondary" >Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  GET specific sale details modal More Info-->
    <!-- Modal -->
    <div class="modal fade" id="pending-discount-details-modal" tabindex="-1" aria-labelledby="sales-details" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Discount Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-holder form-holder-2 mb-2">
                        <label for="name">Customer</label></br>
                        <p id="pending_name" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="pending_vehiclereg">Vehicle Registration & Product</label></br>
                        <p  id="pending_vehiclereg" style="padding-left:5px;"></p>
                    </div>

                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="rewards">Rewards (Total Rewards, Rewards Available)</label></br>
                        <p id="pending_rewards" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <div class="row">
                            <div class="col-6">
                                <label for="Discount">Amount To Redeem (KES)</label></br>
                            </div>
                            <div class="col-6">
                                <p
                                    style="width:90%; margin-right:10%; font-weight:bold; margin-left:-70px; border-color: black; border-width:1px; "
                                    id="pending_discount_value" p></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
