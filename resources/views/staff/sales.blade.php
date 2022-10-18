@extends('staff.layouts.body')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Sales</h6>
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
            <a class="btn btn-primary text-right" style="background-color:#f9a14d;" href="/make-sale">Make Sale</a>
        </div>
        </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
            <div class="table-responsive p-0">
              <table data-ordering="false" id="sales_table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    {{-- <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Sales ID</th> --}}
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Vehicle Registration</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Total Amount Spent</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Total Rewards Used</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Total Rewards Awarded</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Action</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ( $sales as $sale )
                <tr>
                  {{-- <td style="display:none;" class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->id }}</span>
                  </td> --}}
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                  </td>
                 
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                  </td>
                  <td class="align-middle  text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_used }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                  </td>
                  <td class="text-sm">
                       <a href="/specific-sales/{{ $sale->vehicle_registration }}" id="specific_sales_btn" style="background-color:#f9a14d;" class="moresalesdetails btn btn-sm btn-primary" >View All Sales</a>
                  </td>
                 </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Vehicle Registration</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-left text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">Total Amount Spent</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Total Rewards Used</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Total Rewards Awarded</th>
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


@endsection
