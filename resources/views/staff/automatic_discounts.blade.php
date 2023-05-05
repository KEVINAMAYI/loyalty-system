@extends('staff.layouts.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Automatic Discounts</h6>
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
                                <h6>Automatic Discounts</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
                        <div class="table-responsive p-0">
                            <table data-ordering="false" id="automatic_discount_table"
                                   class="table align-items-center mb-0">
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
                                    @if(auth()->user()->major_role == 'Admin')
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                            Action
                                        </th>
                                    @endif
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
                                        @if(auth()->user()->major_role == 'Admin')
                                            @if($automatic_discount->printed == 'Completed')
                                                <td class="text-sm">
                                                    <button id="{{ $automatic_discount->discount_number }}"
                                                            style="background-color:#4881c0"
                                                            class="discount_item disabled print-discount-data-btn btn btn-sm btn-primary">
                                                        Printed
                                                    </button>
                                                </td>
                                            @else
                                                <td class="text-sm">
                                                    <button id="{{ $automatic_discount->discount_number }}"
                                                            style="background-color:#4881c0"
                                                            class="automatic_discount_item print-automatic-discount-data-btn btn btn-sm btn-primary">{{  ucfirst($automatic_discount->printed) }}</button>
                                                </td>
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
                                    @if(auth()->user()->major_role == 'Admin')
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
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
    </div>

@endsection
