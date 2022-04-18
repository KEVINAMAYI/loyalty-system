@extends('staff.layouts.body')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Sales</h6>
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
            <h6>Sales</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Used</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Awarded</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                  <td class="align-middle text-center text-sm">
                    <input type="hidden" id="saleid" value={{ $sale->id }}>
                    <button  id="{{ $sale->id }}"  style="background-color:#f9a14d;" class="moresalesdetails btn btn-sm btn-primary" >more info</button>
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

<!--  GET specific sale details modal -->
<!-- Modal -->
  <div class="modal fade" id="sales-details" tabindex="-1" aria-labelledby="sales-details" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sales Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-holder form-holder-2 mb-2">
              <label for="regno">Firt Name</label></br>
              <p id="firstname" style="padding-left:5px;"></p>
             </div>  
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Last Name</label></br>
              <p  id="lastname" style="padding-left:5px;"></p>
            </div>
            
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Phone Number</label></br>
              <p id="phonenumber" style="padding-left:5px;"></p>
            </div>
  
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Vehicle Registration</label></br>
              <p  id="vehiclereg" style="padding-left:5px;"></p>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Product</label></br>
              <p id="product" style="padding-left:5px;"></p>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Rewards Used</label></br>
              <p id="rewards" style="padding-left:5px;"></p>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Amount Payable</label></br>
              <p id="amountpayable" style="padding-left:5px;"></p>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Amount Paid</label></br>
              <p id="amountpaid" style="padding-left:5px;"></p>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Date Created</label></br>
              <p id="date" style="padding-left:5px;"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           </div>
          </div>
        </div>
      </div>
    </div>
@endsection
