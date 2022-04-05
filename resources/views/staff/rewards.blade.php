@extends('staff.layouts.body')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Rewards</h6>
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
    <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
          </div>
          <div class="card-body px-0 pt-0 pb-2">
          <div class="container">
            <p style="margin-bottom:5px; font-weight:bold; font-size:24px;">Enable/Disable Using Rewards</p>
            <!-- Rounded switch -->
            <label class="switch">
            <input type="checkbox">
                 <span class="slider round"></span>
            </label>
            <form style="margin-top:20px;">
                    <div class="form-group">
                        <label for="exampleInputEmail1"  style="margin-bottom:10px; font-weight:bold; font-size:24px;" >Set Reward percentage</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter reward percentage">
                    </div>
                    <button style="background-color:#f9a14d;" class="btn btn-primary btn-md" type="submit">Submit</button>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>
 </div>
@endsection
