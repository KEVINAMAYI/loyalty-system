@extends('cooperate-customer.layout.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Employees</h6>
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

            <button type="button" style="background-color:#f9a14d;" class="btn btn-primary btn-md"
                data-bs-toggle="modal" data-bs-target="#employees"><i class="fa-solid fa-plus"></i>
                <span style="margin-left:5px;">Add Employee</span></button>


            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Employees</h6>
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
                                                    Email</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach( $employees as $employee)
                                            
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $employee->first_name }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
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
                                                    <a href="" id="{{ $employee->id  }}" class="showeditmodalbtn">
                                                        <span style="background-color:#3875b6;"
                                                            class="badge badge-sm">edit</span></a>
                                                    <a href="/delete-cooperate-employee/{{ $employee->id }}" class="badge badge-sm bg-gradient-danger">delete</a>
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
<!-- Modal -->
<form id="form-add-employee"  method="post" action="add-cooperate-employee">
@csrf
<div class="modal fade" id="employees" tabindex="-1" aria-labelledby="employees" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">First Name</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="employee_firstname" id="employee_firstname" placeholder="Kevin" required>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Last Name</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="employee_lastname" id="employee_lastname" placeholder="Amayi" required>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Phone Number</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="phone_number"  id="phone_number" placeholder="0795704301" required>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">ID Number</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="id_number"  id="id_number" placeholder="34643511" required>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Email</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="email" name="email" id="email" placeholder="kevinamayi20@gmail.com" required>
        </div>
        <div class="form-holder form-holder-2">
          <label for="card-type">Gender</label>
          <select name="employee_gender" id="employee_gender" class="form-control" required>
            <option value="male" selected>Male</option>
            <option value="female">Female</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button style="background-color:#f9a14d; color:white;" id="addemployeebtn" class="btn">Add Employee</button>
      </div>
    </div>
  </div>
</div>
</form>


<!--  Edit employees modal -->
<!-- Modal -->
<form id="form-add-employee"  method="post" action="/edit-employee-data">
  @csrf
<div class="modal fade" id="employeesedit" tabindex="-1" aria-labelledby="employeesedit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">First Name</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="edit_first_name"  id="edit_first_name" placeholder="Kevin" required>
        </div>

        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Last Name</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="edit_last_name"  id="edit_last_name" placeholder="Amayi" required>
        </div>

        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Phone Number</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="edit_phone_number"  id="edit_phone_number" placeholder="0795704301" required>
        </div>

        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">ID Number</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="edit_id_number" id="edit_id_number" placeholder="34643511" required>
        </div>

        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Email</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="email" name="edit_email" id="edit_email" placeholder="kevinamayi20@gmail.com" required>
        </div>

        <div class="form-holder form-holder-2">
          <label for="card-type">Gender</label>
          <select name="edit_gender" id="edit_gender" class="form-control" required>
            <option value="male" selected>Male</option>
            <option value="female">Female</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="employee_edit_id" id="employee_edit_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Edit Employee</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
