@extends('staff.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h3 class="font-weight-bolder mb-0"> {{ ucfirst($organization->name) }}</h3>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 row">
                            <div class="col-md-10">
                                <h6>Sales</h6>
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
                            <table data-ordering="false" id="organization_sales_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    {{-- <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Sales ID</th> --}}
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Vehicle Registration
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Date
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Product
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Litres
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Amount Paid
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Rewards Awarded
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Discount Reedemable<br>(Bulk)
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ( $sales as $sale )
                                    <tr>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->first_name.''.$sale->last_name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($sale->created_at ))}}</span>
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
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ is_null($sale->bulk_rewards) ? 0 : $sale->bulk_rewards }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"></span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"></span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"></span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"><strong>TOTAL</strong></span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $litres_sold }}</span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"><bold>{{ $amount_paid }}</bold></span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $reward_sum }}</span>
                                    </td>
                                    <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $bulk_reward_sum }}</span>
                                    </td>
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
