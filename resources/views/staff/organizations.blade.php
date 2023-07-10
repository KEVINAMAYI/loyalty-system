@extends('staff.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Organizations</h6>
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
                data-bs-target="#addOrganizationModal"><i class="fa-solid fa-plus"></i>
            <span style="margin-left:5px;">Add Organization</span>
        </button>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 row">
                            <div class="col-md-10">
                                <h6>Organizations</h6>
                            </div>
                            <div class="col-md-2">
                                {{--                                --}}{{-- <a class="btn btn-primary text-right" style="background-color:#f9a14d;" href="/sales">--}}
                                {{--                                    <i class="fa-solid fa-arrow-left"></i>--}}
                                {{--                                    Back</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 pr-2 pl-3">
                        <div class="table-responsive p-0">
                            <table data-ordering="false" id="organization_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Description
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Members
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($organizations as $organization)
                                    <tr>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $organization->name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $organization->description }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">50</span>
                                        </td>
                                        <td class="text-sm">
                                            <span id="{{ $organization->id }}" style="background-color:#f9a14d;"
                                                    class="float-left btn editOrganizationBtn badge badge-sm bg-gradient-primary">edit
                                            </span>
                                            <span class="float-left badge badge-sm bg-gradient-info"><a href="{{ route('edit-organization-rewards',$organization->id) }}" class="text-white" id="{{ $organization->id }}">set rewards
                                            </a></span>
                                            <form style="display:inline;" action="{{ route('organizations.destroy',$organization->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <span
                                                        class="float-left btn  badge badge-sm bg-gradient-danger">delete
                                                </span>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>

                                <tr>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Name
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Description
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">
                                        Members
                                    </th>
                                    <th style="border-bottom:1px solid rgb(200, 195, 195);"
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder ps-2">
                                        Action
                                    </th>
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
    <form class="form-register" action="{{ route('organizations.store') }}" method="post">
        @csrf
        <div class="modal fade" id="addOrganizationModal" tabindex="-1" aria-labelledby="staff-modal"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOrganizationModalLabel">Add New Organization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-holder form-holder-2 mb-2">
                            <label for="regno">Name</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="name"  placeholder="Makiga">
                        </div>
                        <div class="form-holder form-holder-2 mt-4 mb-4">
                            <label for="regno">Description</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="description" placeholder="Sacco">
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" style="background-color:#f9a14d; color:white;" type="button"
                                    class="btn">Add Organization
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!--  edit  employees modal -->
    <form id="editOrganizationForm" method="post">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editOrganizationModal" tabindex="-1" aria-labelledby="staff-modal"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrganizationModalLabel">Edit Organization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-holder form-holder-2 mb-2">
                            <label for="regno">Name</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="name" id="organizationName" placeholder="Makiga">
                        </div>
                        <div class="form-holder form-holder-2 mt-4 mb-4">
                            <label for="regno">Description</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="description" id="organizationDescription" placeholder="Sacco">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" style="background-color:#f9a14d; color:white;" type="button"
                                    class="btn">Edit Organization
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
