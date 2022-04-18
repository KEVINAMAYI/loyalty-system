@extends('staff.layouts.body')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Users</h6>
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

      <button type="button" style="background-color:#f9a14d;" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#staff-modal"><i class="fa-solid fa-plus"></i>
          <span style="margin-left:5px;">Add Staff</span>
      </button>

    <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Users</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($staffs as $staff)
                    <tr>
                      <td class="align-middle text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $staff->name }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $staff->email }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <button id="{{ $staff->id }}" style="background-color:#4881c0; border:0px;"  class="editstaff badge badge-sm">edit</button>
                        <a href="/delete-staff/{{ $staff->id }}" class="badge badge-sm bg-gradient-danger">delete</a>
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

<!--  Add employees modal -->
<form class="form-register" action="/add-staff" method="post">
@csrf
<div class="modal fade" id="staff-modal" tabindex="-1" aria-labelledby="staff-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-holder form-holder-2 mb-2">
            <label for="regno">Name</label></br>
            <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="name"  id="name" placeholder="Kevin">
          </div>  
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Email</label></br>
            <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="email" id="email"  placeholder="kevinamayi20@gmail.com">
          </div>
          
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Password</label></br>
            <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="password" name="password" id="password" id="password" placeholder="......">
          </div>

          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Confirm Password</label></br>
            <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="password" name="password_confirmation" id="password_confirmation" id="password_confirmation" placeholder="......">
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Add Staff</button>
         </div>
        </div>
      </div>
    </div>
  </div>
</form>


<!--  edit employees modal -->
  <div class="modal fade" id="edit-staff" tabindex="-1" aria-labelledby="edit-staff" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
            <ul class="list-group" id="errorsul">
            </ul>
          </div> 
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Staff Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-holder form-holder-2 mb-2">
              <label for="regno">Name</label></br>
              <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="name"  id="name" placeholder="Kevin">
            </div>  
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Email</label></br>
              <input id="staffemail" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="email" id="email"  placeholder="kevinamayi20@gmail.com">
            </div>
            <div class="modal-footer">
            <input type="hidden" id="staffid" value="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  id="editstaffbtn" style="background-color:#f9a14d; color:white;" type="button" class="btn">Edit Staff</button>
           </div>
          </div>
        </div>
      </div>
    </div>
 
@endsection
