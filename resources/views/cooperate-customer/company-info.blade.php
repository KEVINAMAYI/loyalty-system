@extends('cooperate-customer.layout.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Company Info</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
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
                <div class="col-lg-3">
                    <div class="card text-center">
                        <div class="card-header">
                            Company Logo
                        </div>
                        <div class="card-body">
                            <img src="/images/{{ $company[0]->logo_url }}" style="border-radius:100%; border:solid 2px rgb(40,50,60)" width="100" height="100" alt="">
                          <h6 style="margin-top:20px;" class="card-title">Special title treatment</h6>
                          <a href="#" class="btn btn-primary">Change Logo</a>
                        </div>
          
                      </div>

                </div>
                <div class="col-lg-9">
                    <div class="card text-left">
                        <div class="card-header">
                            <h5 class="card-title">Company Details</h5>
                        </div>
                        <div class="card-body">
                            <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Name</span>: <span>{{ $company[0]->name }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Email</span>: <span>{{ $company[0]->email }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Phone </span>: <span>{{ $company[0]->phone_number }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Alternative Phone</span>: <span>{{ $company[0]->alternative_phone_number }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Address</span>: <span>{{ $company[0]->address }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >Town</span>: <span>{{ $company[0]->town }}</span></p>
                          <p style="padding:10px; border:1px solid grey; border-radius:10px;" class="card-text"><span style="font-size:16px; font-weight:bold;" >KRA PIN</span>: <span>{{ $company[0]->krapin }}</span></p>
                        </div>
                      </div>

                </div>
            </div>

            <div class="container-fluid py-4">
               
            </div>



@endsection
