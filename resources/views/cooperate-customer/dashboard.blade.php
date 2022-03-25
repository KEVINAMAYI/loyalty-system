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
                                        50
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
                                        60
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
                                        60
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
                                <a href="employees.html" style="background-color:#f9a14d;" type="button"
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
                                                Action</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Amayi</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinamayi@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Musungu</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinmusungu@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Otwane</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinotwane@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Mundoi</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinuonqqdi@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Fidel</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Amayi</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinfidqqqqe@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Donald</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Kipkoech</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">donaldqqqqq@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>
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
                                <a href="vehicles.html" style="background-color:#f9a14d;" type="button"
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
                                                Vehicle Make</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vehicle Model</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Registration</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-items-center">

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Vita</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Vites</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KAG
                                                    445</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Toyota</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Corolla</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KAG
                                                    445</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Morano</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Sola</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KAG
                                                    445</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Mark</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Bot</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KAR
                                                    445</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Ford</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Ranger</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KBG
                                                    445</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Mercedes</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Benz</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">KTG
                                                    445</span>
                                            </td>
                                        </tr>
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
                                <a href="rewards.html" style="background-color:#f9a14d;" type="button"
                                    class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>
                                    <span style="margin-left:5px;">View More</span></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                Action</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Musungu</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinmusungu@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Otwane</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinotwane@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Kevin</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Mundoi</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinuonqqdi@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Fidel</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Amayi</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">kevinfidqqqqe@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">Donald</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Kipkoech</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">0795704301</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">34643511</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">donaldqqqqq@gmail.com</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Male</span>
                                            </td>
                                        </tr>
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
