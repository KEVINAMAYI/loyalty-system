@extends('cooperate-customer.layout.body')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>

                </ul>
            </div>
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Employees</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ count($employees) !=null ? count($employees) : 0 }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div style="background-color:#f9a14d;"
                                    class="icon icon-shape shadow text-center border-radius-md">
                                    <i class="fa-solid fa-person" style="color:white;"></i>
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Vehicles</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{  count($vehicles) != null ? count($vehicles) : 0  }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div style="background-color:#f9a14d;"
                                    class="icon icon-shape shadow text-center border-radius-md">
                                    <i class="fa-solid fa-car" style="color:white;"></i>
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Authorized Fuel
                                        Purchases</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ count($authorized_purchases) != null ? count($authorized_purchases) : 0 }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div style="background-color:#f9a14d;"
                                    class="icon icon-shape shadow text-center border-radius-md">
                                    <i class="fa-solid fa-dollar" style="color:white;"></i>
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
                            <h6>Employees</h6>
                            <div style="text-align:right;">
                                <a href="/cooperate-customer-employees" style="background-color:#f9a14d;" type="button"
                                    class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                                    <span style="margin-left:5px;">View More</span></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                First Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Last Name</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phonenumber</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID Number</th>
                                         
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Gender
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      
                                        @foreach( $employees as $employee)
                                            
                                        <tr>
                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $employee->first_name }}</p>
                                            </td>
                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $employee->last_name }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $employee->phone_number }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $employee->id_number }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $employee->email }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $employee->gender }}</span>
                                            </td>
                                          </tr>

                                        @endforeach

                                     </tbody>
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
                            <h6>Vehicles</h6>
                            <div style="text-align:right;">
                                <a href="/cooperate-customer-vehicles" style="background-color:#f9a14d;" type="button"
                                    class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                                    <span style="margin-left:5px;">View More</span></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table  align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Category</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vehicle Type</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Registration</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-items-center">

                                        @foreach( $vehicles as $vehicle)

                                        <tr>
                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $vehicle->vehicle_category }}</p>
                                            </td>
                                            <td class="align-middle text-left text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $vehicle->vehicle_type }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $vehicle->vehicle_registration }}</span>
                                            </td>
                                           
                                        </tr>   

                                    @endforeach
                                    </tbody>
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
                            <h6>Authorize Fuel Purchase</h6>
                            <div style="text-align:right;">
                                <a href="/cooperate-customer-authorizepurchase" style="background-color:#f9a14d;" type="button"
                                    class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                                    <span style="margin-left:5px;">View More</span></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">

                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7 ps-2">
                                                Id Number</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Receipt Number</th>
                                             <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        @foreach( $authorized_purchases as $authorized_purchase) 

                                        <tr>
                                            <td style="padding-left:20px;" class="align-left text-left text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $authorized_purchase[0][0]->first_name }}   {{ $authorized_purchase[0][0]->last_name }}</p>
                                            </td>
                                            <td class="align-middle text-left text-sm">
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
                                                    class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->receipt_number }}</span>
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
