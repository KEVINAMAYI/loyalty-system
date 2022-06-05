@extends('staff.layouts.body')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Cooperate Customers</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Authorized Fuel Purchases</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="authrorized_purchases_table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Id Number</th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount</th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Receipt Number
                                            </th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Company Name</th>
                                             <th
                                             style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
   
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach( $authorized_purchases as $authorized_purchase) 

                                            <tr>
                                                <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $authorized_purchase[0][0]->first_name }}   {{ $authorized_purchase[0][0]->last_name }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[0][0]->id_number }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[1][0]->vehicle_type }}  {{ $authorized_purchase[1][0]->vehicle_registration }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->amount }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->receipt_number }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->name }}
                                                    </span>                                                
                                                </td>
                                                @if( $authorized_purchase[2]->status == 'complete' )

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-success">{{ $authorized_purchase[2]->status }}</span>
                                                </td>

                                                @else

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                                </td>

                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Id Number</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Receipt Number
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Company Name</th>
                                             <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
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
