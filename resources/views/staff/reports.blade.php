@extends('staff.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Reports</h6>
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
                                <h6>Organization Discounts</h6>
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
                            <table data-ordering="false" id="organization_discount_report_table"
                                   class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Organization
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( $sales as $sale )
                                    @if($sale->sales_type == 'organization')

                                <tr>
                                 <td class="text-sm">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ App\Models\Organization::where('id', $sale->organization_id)->value('name')}}</span>
                                </td>
                                    <td class="text-sm">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('H-m-i', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->sold_by }}</span>
                                            </td>
                                            {{--                                            <td class="text-sm">--}}
                                            {{--                                            <span--}}
                                            {{--                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump }}</span>--}}
                                            {{--                                            </td>--}}
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump_side }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->product }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->litres_sold }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_payable }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->first_name.' '.$sale->last_name }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->phone_number }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Organization
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
                                    </th>
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
                            <table data-ordering="false" id="manual_discount_report_table"
                                   class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( $sales as $sale )
                                    @if($sale->sales_type == 'customer')
                                        <tr>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('H-m-i', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->sold_by }}</span>
                                            </td>
{{--                                            <td class="text-sm">--}}
{{--                                            <span--}}
{{--                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump }}</span>--}}
{{--                                            </td>--}}
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump_side }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->product }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->litres_sold }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_payable }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->first_name.' '.$sale->last_name }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->phone_number }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
                                    </th>
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
                            <table data-ordering="false" id="automatic_discount_report_table"
                                   class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( $sales as $sale )
                                    @if($sale->sales_type == 'bulk')
                                        <tr>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('H-m-i', strtotime($sale->created_at ))}}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->sold_by }}</span>
                                            </td>
                                            {{--                                            <td class="text-sm">--}}
                                            {{--                                            <span--}}
                                            {{--                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump }}</span>--}}
                                            {{--                                            </td>--}}
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->pump_side }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->product }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->litres_sold }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_payable }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->first_name.' '.$sale->last_name }}</span>
                                            </td>
                                            <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->phone_number }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Transaction Time
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Attendant Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Pump No
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Pump Side
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Volume (Ltr)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount (KES)
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Rewarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Vehicle Number
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Driver Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Phone Number
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

@endsection
