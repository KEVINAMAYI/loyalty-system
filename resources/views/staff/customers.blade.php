@extends('staff.layouts.body')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  
  
  <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Customers</h6>
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

      {{-- display success message on a successful action --}}
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
      @endif
  
      {{-- display error on top of the form --}}
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
          <ul class="list-group">
              @foreach ($errors->all() as $error )
              <li class="list-group-item">
                {{ $error }}  
              </li>
              @endforeach
          </ul>
      </div>
      @endif
      
    <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Customers</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phonenumber</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Number</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">more info</span>
                        <span style="background-color:#4881c0" class="badge badge-sm">edit</span>
                        <a href="/customers/{{ $customer->id }}" class="badge badge-sm bg-gradient-danger">delete</a>
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
 
@endsection
