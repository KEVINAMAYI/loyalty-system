@extends('staff.body')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h3 class="font-weight-bolder mb-0">{{ ucfirst($customer->first_name.' '.$customer->last_name) }}</h3>
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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        {{--                                        <h6>Petrol Rewards</h6>--}}
                                    </div>
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Product
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Rewards in Shillings
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Month
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($petrol_reward_formats as $petrol_reward_format)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        <p style="text-align:left; padding-left:20px;"
                                                           class="text-xs font-weight-bold mb-0">
                                                            Petrol
                                                        </p>
                                                    </td>

                                                    <td class="align-middle text-center text-sm">
                            <span
                                class="text-secondary text-xs font-weight-bold">
                                {{ $petrol_reward_format->shillings_per_litre }} / LITRE
                            </span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                          <span
                              class="text-secondary text-xs font-weight-bold">
                              {{ $petrol_reward_format->period }}
                          </span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <button id="{{ $petrol_reward_format->id }}"
                                                                style="border:0px; background-color:#3875b6;"
                                                                class="editCustomerRewardBtn badge badge-sm">edit
                                                        </button>
                                                        {{-- <a href="/delete-cooperate-employee/" class="badge badge-sm bg-gradient-danger">delete</a> --}}
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

                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        {{--                                        <h6>Diesel Rewards</h6>--}}
                                    </div>
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Product
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Rewards in Shillings
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Month
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($diesel_reward_formats as $diesel_reward_format)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        <p style="text-align:left; padding-left:20px;"
                                                           class="text-xs font-weight-bold mb-0">
                                                            Diesel
                                                        </p>
                                                    </td>


                                                    <td class="align-middle text-center text-sm">
                            <span
                                class="text-secondary text-xs font-weight-bold">
                                {{ $diesel_reward_format->shillings_per_litre }} / LITRE
                            </span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                          <span
                              class="text-secondary text-xs font-weight-bold">
                              {{ $diesel_reward_format->period }}
                          </span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <button id="{{ $diesel_reward_format->id }}"
                                                                style="border:0px; background-color:#3875b6;"
                                                                class="editCustomerRewardBtn badge badge-sm">edit
                                                        </button>
                                                        {{-- <a href="/delete-cooperate-employee/" class="badge badge-sm bg-gradient-danger">delete</a> --}}
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
            </div>
        </div>
    </div>

    {{-- edit monthly rewards --}}
    <form id="editCustomerRewardForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editCustomerRewardModel" tabindex="-1" aria-labelledby=""
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;"
                         class="alert alert-danger" id="errorz" role="alert">
                        <ul class="list-group" id="errorsul">
                        </ul>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrganizationRewardLabel">Edit Rewards</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-holder form-holder-2 mb-2">
                            <label for="regno">Reward Per Litre(KES)</label></br>
                            <input id="staffname"
                                   style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                   type="text" name="reward_per_litre" class="reward_per_litre" placeholder="2.5">
                        </div>
                        <div class="form-holder form-holder-2">
                            <label for="month">Month</label>
                            <select name="month" class="monthly form-control">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="Necember">December</option>
                            </select>
                        </div>
                        <div class="form-holder form-holder-2 mb-2">
                            <label for="year">Year</label></br>
                            <input type="number"
                                   style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                   class="reward_year" name="reward_year" min="2022" max="2050" step="1">
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="customer_reward_id" name="organizational_reward_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" style="background-color:#f9a14d; color:white;"
                                    class="btn">Edit Reward
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
