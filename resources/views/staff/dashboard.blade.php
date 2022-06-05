@extends('staff.layouts.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
      </nav>
      
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Customers</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ count($customers) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div style="background-color:#f9a14d;" class="icon icon-shape  shadow text-center border-radius-md">
                  <i class="fa-solid fa-person" style="color:white;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Authorized Purchases</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ count($authorized_purchases) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div style="background-color:#f9a14d;" class="icon icon-shape shadow text-center border-radius-md">
                  <i class="fa-solid fa-car" style="color:white;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ count($sales) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div style="background-color:#f9a14d;" class="icon icon-shape shadow text-center border-radius-md">
                  <i class="fa-solid fa-car" style="color:white;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Sales</h6>
              <div style="text-align:right;">
                <a style="background-color:#f9a14d;" href="/sales" type="button" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                  <span style="margin-left:5px;">View More</span></a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="dashboard_sales_table" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Used</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Awarded</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    </tr>
                  </thead>
                  <tbody>
    
                  @foreach ( $sales as $sale )
                  <tr>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">{{ $sale->first_name }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $sale->last_name }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_used }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $sale->created_at }}</span>
                    </td>
                    
                  </tr>
                  @endforeach
    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                      <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                      <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Used</th>
                      <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Awarded</th>
                      <th  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                      <th  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    </tr>

                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Authorized Purchases</h6>
              <div style="text-align:right;">
                <a style="background-color:#f9a14d; margin-bottom:20px;" href="/authorized-purchases" type="button" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                  <span style="margin-left:5px;">View More</span></a>
              </div>
            </div>
            <div class="card-body  px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table  id="dashboard_authorization_table" class="table align-items-center mb-0">
                  <thead >
                      <tr>
                          <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Name</th>
                          <th style="border-bottom:1px solid rgb(200, 195, 195);"
                              class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                              Id Number</th>
                          <th style="border-bottom:1px solid rgb(200, 195, 195);"
                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Vehicle</th>
                          <th style="border-bottom:1px solid rgb(200, 195, 195);"
                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Amount</th>
                          <th style="border-bottom:1px solid rgb(200, 195, 195);"
                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Company Name</th>
                           <th style="border-bottom:1px solid rgb(200, 195, 195);"
                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Status
                          </th>
  
                      </tr>
                  </thead>
                  <tbody>
  
                      @foreach( $authorized_purchases as $authorized_purchase) 
  
                          <tr >
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
                  <tfoot style="border-bottom:0px;">
                    <tr style="border-bottom:0px;">
                      <th style="padding-left:30px; border-bottom:0px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Name</th>
                      <th style="border-bottom:0px;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                          Id Number</th>
                      <th style="border-bottom:0px;"
                          class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Vehicle</th>
                      <th style="border-bottom:0px;"
                          class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Amount</th>
                      <th style="border-bottom:0px;"
                          class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Company Name</th>
                       <th style="border-bottom:0px;"
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

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Customer</h6>
              <div style="text-align:right;">
                <a style="background-color:#f9a14d;" href="/customers" type="button" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                  <span style="margin-left:5px;">View More</span></a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="dashboard_customer_table" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phonenumber</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Number</th>
                      <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    </tr>
                  </thead>
                  <tbody>
  
                    @foreach ( $customers as $customer)
                      <tr>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs font-weight-bold mb-0">{{ $customer->first_name }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold">{{ $customer->last_name }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold">{{ $customer->phone_number }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold">{{ $customer->id_number }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold">{{ $customer->email }}</span>
                        </td>
                      </tr>
                    @endforeach
  
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phonenumber</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
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
