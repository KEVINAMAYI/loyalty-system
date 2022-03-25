@extends('cooperate-customer.layout.body')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Vehicles</h6>
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

        <button type="button" style="background-color:#f9a14d;" class="btn btn-success btn-md" data-bs-toggle="modal"
            data-bs-target="#vehicles"><i class="fa-solid fa-plus"></i>
            <span style="margin-left:5px;">Add Vehicle</span></button>


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Vehicles</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table  align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Make</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vehicle Model</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Registration</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>

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
                                                <span class="text-secondary text-xs font-weight-bold">KAG 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
                                                <span class="text-secondary text-xs font-weight-bold">KAG 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
                                                <span class="text-secondary text-xs font-weight-bold">KAG 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
                                                <span class="text-secondary text-xs font-weight-bold">KAR 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
                                                <span class="text-secondary text-xs font-weight-bold">KBG 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
                                                <span class="text-secondary text-xs font-weight-bold">KTG 445</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#vehiclesedit">
                                                    <span style="background-color:#3875b6;"
                                                        class="badge badge-sm">edit</span></a>
                                                <span class="badge badge-sm bg-gradient-danger">delete</span>
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
    @endsection
