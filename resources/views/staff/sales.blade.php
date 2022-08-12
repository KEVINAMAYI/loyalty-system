@extends('staff.layouts.body')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Sales</h6>
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
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Sales</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="sales_table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder">Name</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder  ps-2">Rewards Used</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Rewards Awarded</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Rewards Balance</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Vehicle Registration</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Amount</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Sold By</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Date</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Status</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Action</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ( $sales as $sale )
                <tr>
                  <td class="text-sm">
                    <span  class="text-xs font-weight-bold mb-0">{{ $sale->first_name }} {{ $sale->last_name }}</span>
                  </td>
                  <td class="align-middle  text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_used }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->rewards_awarded }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ App\Models\Customer::where('phone_number','=',$sale->phone_number)->value('rewards') }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->vehicle_registration }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->amount_paid }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->sold_by }}</span>
                  </td>
                  <td class="text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $sale->created_at }}</span>
                  </td>
                  @if((Auth::user()->major_role == 'Supervisor') || (Auth::user()->major_role == 'Admin'))
                         @if($sale->status == 'Accepted')
                            <td class="align-middle text-center text-sm">
                              <span style="cursor:pointer" phone_number={{ $sale->phone_number }} sale_id={{ $sale->id }}   class="salestatusbtn badge badge-sm bg-gradient-success">Accepted</span>
                            </td>
                          @elseif($sale->status == 'Rejected')
                             <td class="align-middle text-center text-sm">
                               <span style="cursor:pointer" phone_number={{ $sale->phone_number }}  sale_id={{ $sale->id }} class="salestatusbtn badge badge-sm bg-gradient-danger">Rejected</span>
                             </td>
                          @else
                            <td class="align-middle text-center text-sm">
                              <span style="cursor:pointer" phone_number={{ $sale->phone_number }}  sale_id={{ $sale->id }} class="salestatusbtn badge badge-sm bg-gradient-warning">Pending</span>
                            </td>
                         @endif
                      @else
                        <td class="text-sm">
                          <span style="cursor:pointer" phone_number={{ $sale->phone_number }} sale_id={{ $sale->id }}   class="badge badge-sm bg-gradient-success">{{ $sale->status }}</span>
                        </td>
                      @endif
                  <td class="text-sm">
                    <input type="hidden" id="saleid" value={{ $sale->id }}>
                    <button  id="{{ $sale->id }}"  style="background-color:#f9a14d;" class="moresalesdetails btn btn-sm btn-primary" >more info</button>
                  </td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Used</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rewards Awarded</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Rewards Balance</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-uppercase text-secondary text-left text-xxs font-weight-bolder ps-2">Vehicle Registration</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sold By</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-left text-secondary text-xxs font-weight-bolder">Status</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);"  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

<!--  GET specific sale details modal More Info-->
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
            <div class="form-holder form-holder-2 mt-4 mb-4">
                 <label for="regno">Image</label></br>
                <img id="vehicle_image" src="" style="border:4px solid grey; width:200px; height:200px;" alt="">									
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Pump Image</label></br>
             <img id="pump_image" src="" style="border:4px solid grey; width:200px; height:200px;" alt="">									
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Receipt Image</label></br>
              <img id="receipt_image" src="" style="border:4px solid grey; width:200px; height:200px;" alt="">									
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Approved By</label></br>
              <p id="sale_approved_by" style="padding-left:5px;"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           </div>
          </div>
        </div>
      </div>
    </div>


    <!--  enrollment status employees modal -->
  <form action="/set-sale-status" method="POST">
   @csrf
  <div class="modal fade" id="sale-status-modal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
          <ul class="list-group" id="errorsul">
          </ul>
        </div> 
        <div class="modal-header">
          <h5 class="modal-title" id="sale-status-modal">Set Sale Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="sales_status">Set Status</label></br>
            <select name="sales_status" id="sales_status" class="form-control">
                <option value="Accepted">Accept</option>
                <option value="Rejected">Reject</option>
            </select>          
          </div>
          <div id="sales_reason_div" style="display:none;" class="form-holder form-holder-2 mt-4 mb-4">
          <label for="sales_status_reason">Reason for Rejecting/Accepting</label></br>
            <textarea  name="sales_status_reason" id="sale_status_reason" style="width:100%; margin-bottom:20px; padding-left:0px;" rows="3"> </textarea>
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="hidden" name="salestatus_id" id="salestatus_id" value="">
          <input type="hidden" name="salestatuscustomer_phone" id="salestatuscustomer_phone" value="">
          <button type="submit" style="background-color:#f9a14d; color:white;"  class="btn">Set Status</button>
         </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
