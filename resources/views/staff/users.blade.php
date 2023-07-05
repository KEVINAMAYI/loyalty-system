@extends('staff.body')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Users</h6>
            </nav>
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

        <button type="button" style="background-color:#f9a14d;" class="btn btn-primary btn-md" data-bs-toggle="modal"
                data-bs-target="#staff-modal"><i class="fa-solid fa-plus"></i>
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
                                <table id="staff_table" class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role
                                        </th>
                                        <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Shift
                                        </th>
                                        @if(auth()->user()->major_role == 'Admin')
                                            <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($staffs as $staff)
                                        <tr>
                                            <td class="align-middle text-left text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $staff->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $staff->email }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $staff->major_role }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $staff->shift }}</span>
                                            </td>
                                            @if(auth()->user()->major_role == 'Admin')
                                                <td class="align-middle text-center text-sm">
                                                    <button id="{{ $staff->id }}"
                                                            style="background-color:#4881c0; border:0px;"
                                                            class="editstaff badge badge-sm">edit
                                                    </button>
                                                    <a href="/delete-staff/{{ $staff->id }}"
                                                       class="badge badge-sm bg-gradient-danger">delete</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Shift
                                        </th>
                                        @if(auth()->user()->major_role == 'Admin')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        @endif
                                    </tr>
                                    </tfoot>
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                    <label for="regno">Name</label></br>
                                    <input
                                        style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                        type="text" name="name" id="name" placeholder="">
                                </div>
                                <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                    <label for="regno">Email</label></br>
                                    <input
                                        style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                        type="text" name="email" id="email" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-holder  col-lg-6 col-md-12 col-sm-12 form-holder-2  mb-4">
                                    <label for="regno">Password</label></br>
                                    <input
                                        style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                        type="password" name="password" id="password" id="password" placeholder="">
                                </div>

                                <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2  mb-4">
                                    <label for="regno">Confirm Password</label></br>
                                    <input
                                        style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                        type="password" name="password_confirmation" id="password_confirmation"
                                        id="password_confirmation" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                    <label for="major_role">Role</label></br>
                                    <select name="major_role" id="payment_type" class="form-control">
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                        <option value="Supervisor">Supervisor</option>
                                    </select>
                                </div>
                                <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2  mb-4">
                                    <label for="shift">Shift</label></br>
                                    <select name="shift" id="shift" class="form-control">
                                        <option value="Chui">Chui</option>
                                        <option value="Simba">Simba</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" style="background-color:#f9a14d; color:white;" type="button"
                                        class="btn">Add Staff
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!--  edit employees modal -->
        <div class="modal fade" id="edit-staff" tabindex="-1" aria-labelledby="edit-staff" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;"
                         class="alert alert-danger" id="errorz" role="alert">
                        <ul class="list-group" id="errorsul">
                        </ul>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Staff Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                <label for="regno">Name</label></br>
                                <input
                                    style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                    type="text" name="edited_staffname" id="edited_staffname" placeholder="Kevin">
                            </div>
                            <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2  mb-4">
                                <label for="edited_staffemail">Email</label></br>
                                <input
                                    style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                    type="text" name="edited_staffemail" id="edited_staffemail"
                                    placeholder="kevinamayi20@gmail.com">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                <label for="edited_major_role">Role</label></br>
                                <select name="edited_major_role" id="edited_major_role" class="form-control">
                                    <option value="Staff">Staff</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2 mb-4">
                                <label for="edited_shift">Shift</label></br>
                                <select name="edited_shift" id="edited_shift" class="form-control">
                                    <option value="Chui">Chui</option>
                                    <option value="Simba">Simba</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-holder col-lg-6 col-md-12 col-sm-12 form-holder-2  mb-4">
                                <label for="edited_password">New Password</label></br>
                                <input id="edited_staffpassword"
                                       style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                       type="password" name="edited_staffpassword" id="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="staffid" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="editstaffbtn" style="background-color:#f9a14d; color:white;" type="button"
                                    class="btn">Edit Staff
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
