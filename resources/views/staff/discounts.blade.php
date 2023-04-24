@extends('staff.layouts.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Discounts</h6>
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
                                <h6>Manual Discounts</h6>
                            </div>
                            <div class="col-md-2">
                                {{--                                --}}{{-- <a class="btn btn-primary text-right" style="background-color:#f9a14d;" href="/sales">--}}
                                {{--                                    <i class="fa-solid fa-arrow-left"></i>--}}
                                {{--                                    Back</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
                        <div class="table-responsive p-0">
                            <table data-ordering="false" id="discount_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Discount Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        User (CSA)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount Redeemed
                                    </th>
                                    @if(auth()->user()->major_role == 'Admin')
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                            Approver
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">
                                            Approval Date
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                            Action
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ( $discounts as $discount )
                                    <tr>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->id }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->customer->first_name.' '.$discount->customer->last_name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->csa }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->amount }}</span>
                                        </td>
                                        @if(auth()->user()->major_role == 'Admin')
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->approver }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $discount->approved_date == null ? "" : \Carbon\Carbon::parse($discount->approved_date)->format('d/m/Y H:i:s') }}</span>
                                            </td>
                                            @if($discount->status == 'pending')
                                                <td class="text-sm">
                                                    <button discount_id="{{ $discount->id }}"
                                                            id="{{ $discount->customer->id }}"
                                                            style="background-color:#f9a14d;"
                                                            class="approve-discount-btn btn btn-sm btn-primary">Approve
                                                    </button>
                                                </td>
                                            @else
                                                @if($discount->printed == 'Completed')
                                                    <td class="text-sm">
                                                        <a id="{{ "discount_item_$discount->id"}}" href=""
                                                           style="background-color:#4881c0"
                                                           class="discount_item disabled print-discount-data-btn btn btn-sm btn-primary">Printed</a>
                                                    </td>
                                                @else
                                                    <td class="text-sm">
                                                        <a id="{{ "$discount->id"}}"
                                                           href="/discount-pdf/{{ $discount->id  }}"
                                                           style="background-color:#4881c0"
                                                           class="discount_item print-discount-data-btn btn btn-sm btn-primary">Print</a>
                                                    </td>

                                                @endif
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Discount Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        User (CSA)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount Redeemed
                                    </th>
                                    @if(auth()->user()->major_role == 'Admin')
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                            Approver
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">
                                            Date
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                            Action
                                        </th>
                                    @endif
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 row">
                            <div class="col-md-10">
                                <h6>Automatic Discounts</h6>
                            </div>
                            <div class="col-md-2">
                                {{--                                --}}{{-- <a class="btn btn-primary text-right" style="background-color:#f9a14d;" href="/sales">--}}
                                {{--                                    <i class="fa-solid fa-arrow-left"></i>--}}
                                {{--                                    Back</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
                        <div class="table-responsive p-0">
                            <table data-ordering="false" id="discount_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Discount Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Phone
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Litres Sold
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Redeemed Discount
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        User (CSA)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ( $automatic_discount_data as $automatic_discount )
                                    <tr>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->discount_number }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->customer_name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->customer_phone }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->product }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->litres_sold }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->discount }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $automatic_discount->csa }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($automatic_discount->transaction_date)->format('d/m/Y H:i:s')  }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Discount Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Customer Phone
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Litres Sold
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Redeemed Discount
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        User (CSA)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
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
    <div class="modal fade" id="confirm-discount-details-modal" tabindex="-1" aria-labelledby="sales-details"
         aria-hidden="true">
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
                        <label for="vehiclereg">Vehicle Registration</label></br>
                        <p id="vehiclereg" style="padding-left:5px;"></p>
                    </div>

                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="rewards">Rewards (Total Rewards)</label></br>
                        <p id="rewards" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4">
                        <div class="row">
                            <div class="col-6">
                                <label for="Discount">Amount Reedemed (KES)</label></br>
                            </div>
                            <div class="col-6">
                                <p
                                    style="width:90%; margin-right:10%; font-weight:bold; margin-left:-70px; border-color: black; border-width:1px; "
                                    id="discount_value" p></p>
                            </div>
                        </div>

                    </div>
                    <div class="form-holder form-holder-2 mb-4">
                        <label for="discount_pump">Pump, Side</label></br>
                        <p id="discount_pump" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mb-4">
                        <label for="created_at">Created At</label></br>
                        <p id="created_at" style="padding-left:5px;"></p>
                    </div>
                    <div class="form-holder form-holder-2 mt-4 mb-4">
                        <label for="discount_pump">GeoLocation</label></br>
                        <p id="geolocation" style="padding-left:5px;"></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="discount_id" name="discount_id" value="">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button id="set_discount_status_btn" style="margin-left:60%;" type="button"
                                class="btn  btn-secondary">save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
