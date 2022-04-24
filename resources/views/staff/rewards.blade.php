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
          </div>
          <div class="card-body px-0 pt-0 pb-2">
          <div class="container">
            <p style="margin-bottom:5px; font-weight:bold; font-size:24px;">Enable/Disable Using Rewards</p>
            <!-- Rounded switch -->
            <label class="switch">
            <input type="checkbox" id="rewards_checkbox">
                 <span class="slider round"></span>
            </label>
           </div>
          </div>
        </div>
        <div class="container-fluid py-4">
          <div class="row">
              <div class="col-12">
                  <div class="card mb-4">
                      <div class="card-header pb-0">
                          <h6>Products</h6>
                      </div>
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                      <thead>
                          <tr>
                              <th
                                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                  Product</th>
                              <th
                                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Unit</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                  Cost</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                  Period</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                  Action</th>
                          </tr>
                      </thead>
                      <tbody>  
                        @foreach($products_details as $product_details)                
                          <tr>
                              <td class="align-middle text-center text-sm">
                                  <p style="text-align:left; padding-left:20px;" class="text-xs font-weight-bold mb-0">{{ $product_details->product }}</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <p style="text-align:left; padding-left:10px;" class="text-secondary text-xs text-left font-weight-bold"> {{ $product_details->unit }}</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span
                                      class="text-secondary text-xs font-weight-bold">{{ $product_details->cost }}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span
                                      class="text-secondary text-xs font-weight-bold">{{ $product_details->price_period }}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                      <button id="{{ $product_details->id }}" style="border:0px; background-color:#3875b6;" class="editproductbtn badge badge-sm">edit</button>
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
                    <h6>Monthly Rewards</h6>
                </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Range</th>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Reward Type</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Rewards in Shillings</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Reward Period</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action</th>
                </tr>
            </thead>
                <tbody>  
                  @foreach($rewards_monthly as $reward_monthly)                
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p style="text-align:left; padding-left:20px;" class="text-xs font-weight-bold mb-0">{{ $reward_monthly->low }} - {{ $reward_monthly->high }} </p>
                        </td>
                        
                        <td class="align-middle text-center text-sm">
                            <span
                                class="text-secondary text-xs font-weight-bold">{{ $reward_monthly->reward_type }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span
                                class="text-secondary text-xs font-weight-bold">{{ $reward_monthly->shillings_per_litre }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span
                              class="text-secondary text-xs font-weight-bold">{{ $reward_monthly->price_period }}</span>
                      </td>
                        <td class="align-middle text-center text-sm">
                          <button id="{{ $reward_monthly->id }}" style="border:0px; background-color:#3875b6;" class="editmonthlyrewardbtn badge badge-sm">edit</button>
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
                  <h6>Bulk Rewards</h6>
              </div>
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                  <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Range</th>
                  <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Reward Type</th>
                  <th
                      class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Rewards in Shillings</th>
                  <th
                      class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Reward Period</th>
                  <th
                      class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Action</th>
              </tr>
          </thead>
              <tbody>  
                @foreach($rewards_bulk as $reward_bulk)                
                  <tr>
                      <td class="align-middle text-center text-sm">
                          <p style="text-align:left; padding-left:20px;" class="text-xs font-weight-bold mb-0">{{ $reward_bulk->low }} - {{ $reward_bulk->high }} </p>
                      </td>
                      
                      <td class="align-middle text-center text-sm">
                          <span
                              class="text-secondary text-xs font-weight-bold">{{ $reward_bulk->reward_type }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                          <span
                              class="text-secondary text-xs font-weight-bold">{{ $reward_bulk->shillings_per_litre }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span
                            class="text-secondary text-xs font-weight-bold">{{ $reward_bulk->price_period }}</span>
                    </td>
                      <td class="align-middle text-center text-sm">
                          <button id="{{ $reward_bulk->id }}" style="border:0px; background-color:#3875b6;" class="editbulkrewardbtn badge badge-sm">edit</button>
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


 {{-- edit product --}}
 <!--  edit product modal -->
 <form action="/edit-product" method="post">
  @csrf
 <div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="edit-product" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
        <ul class="list-group" id="errorsul">
        </ul>
      </div> 
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Cost</label></br>
          <input id="product_cost" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="product_cost"  id="product_cost" placeholder="144.05">
        </div>  
        <div class="form-holder form-holder-2">
          <label for="month">Month</label>
          <select name="month" id="month" class="form-control">
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
          <input type="number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " id="product_year" name="product_year" min="2022" max="2050" step="1">
        </div>  
        <div class="modal-footer">
        <input type="hidden" id="staffid" value="">
        <input type="hidden" name="product_id" id="product_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  style="background-color:#f9a14d; color:white;"  class="btn">Edit Product</button>
       </div>
      </div>
    </div>
  </div>
</div>
</form>

{{-- edit monthly rewards --}}
<form action="/edit-monthly-reward" method="POST">
  @csrf
 <div class="modal fade" id="edit-monthly-reward" tabindex="-1" aria-labelledby="edit-monthly-reward" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
        <ul class="list-group" id="errorsul">
        </ul>
      </div> 
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Monthly Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Lower Range(Ltrs)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="lower_range"  class="lower_range" placeholder="100">
        </div>  
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Higher Range(Ltrs)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="higher_range"  class="higher_range" placeholder="200">
        </div> 
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Reward Per Litre(KES)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="reward_per_litre"  class="reward_per_litre" placeholder="2.5">
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
          <input type="number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " class="reward_year" name="reward_year" min="2022" max="2050" step="1">
        </div>  
        <div class="modal-footer">
        <input type="hidden" id="monthly_reward_id" name="monthly_reward_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  id="editstaffbtn" style="background-color:#f9a14d; color:white;" class="btn">Edit Reward</button>
       </div>
      </div>
    </div>
  </div>
</div>
</form>


 <!--  edit bulk modal -->
 <form action="/edit-bulk-reward" method="post">
  @csrf
 <div class="modal fade" id="edit-bulk-reward" tabindex="-1" aria-labelledby="edit-monthly-reward" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
        <ul class="list-group" id="errorsul">
        </ul>
      </div> 
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Monthly Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Lower Range(Ltrs)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="lower_range" class="lower_range"  id="bulk_lower_range" placeholder="100">
        </div>  
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Higher Range(Ltrs)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="higher_range" class="higher_range"  id="bulk_higher_range" placeholder="200">
        </div> 
        <div class="form-holder form-holder-2 mb-2">
          <label for="regno">Reward Per Litre(KES)</label></br>
          <input id="staffname" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="reward_per_litre" class="reward_per_litre" id="bulk_reward_per_litre" placeholder="2.5">
        </div>
        <div class="form-holder form-holder-2">
          <label for="month">Month</label>
          <select name="month" id="month" class="monthly form-control">
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
          <input type="number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " id="bulk_reward_year" name="reward_year" class="reward_year" min="2022" max="2050" step="1">
        </div>  
        <div class="modal-footer">
        <input type="hidden" id="bulk_reward_id" name="bulk_reward_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="editstaffbtn" style="background-color:#f9a14d; color:white;" type="button" class="btn">Edit Reward</button>
       </div>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
