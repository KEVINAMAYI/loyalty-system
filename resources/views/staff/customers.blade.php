@extends('staff.layouts.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  
  <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Customers</h6>
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
            <h6>Customers</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="customer_table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phonenumber</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle Registration Number</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Enrolled By</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date/Time</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ( $customers as $customer)
                    <tr>
                      <td class="align-middle text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $customer->first_name }}  {{ $customer->last_name }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $customer->phone_number }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ App\Models\Vehicle::where('customer_id','=',$customer->id)->value('vehicle_registration') != null ? App\Models\Vehicle::where('customer_id','=',$customer->id)->value('vehicle_registration') : "No Vehicle Assigned"  }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $customer->enrolled_by }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $customer->created_at }}</span>
                      </td>
                      @if((Auth::user()->major_role == 'Supervisor') || (Auth::user()->major_role == 'Admin'))
                         @if($customer->status == 'Accepted')
                            <td class="align-middle text-center text-sm">
                              <span style="cursor:pointer" customer_id={{ $customer->id }}   class="customerstatusbtn badge badge-sm bg-gradient-success">Accepted</span>
                            </td>
                          @elseif($customer->status == 'Rejected')
                             <td class="align-middle text-center text-sm">
                               <span style="cursor:pointer" customer_id={{ $customer->id }} class="customerstatusbtn badge badge-sm bg-gradient-danger">Rejected</span>
                             </td>
                          @else
                            <td class="align-middle text-center text-sm">
                              <span style="cursor:pointer" customer_id={{ $customer->id }} class="customerstatusbtn badge badge-sm bg-gradient-warning">Pending</span>
                            </td>
                         @endif
                      @else
                        <td class="align-middle text-center text-sm">
                          <span class="customerstaus badge badge-sm bg-gradient-success">{{ $customer->status }}</span>
                        </td>
                      @endif
                      
                      <td class="align-middle text-center text-sm">
                        <span style="cursor:pointer;" id="{{ $customer->id }}" class="morecustomerdetails badge badge-sm bg-gradient-secondary">more info</span>
                        <span id="{{ $customer->id }}" style="background-color:#4881c0; cursor:pointer;" class="editcustomerbtn badge badge-sm">edit</span>
                        {{-- <a href="/customers/{{ $customer->id }}" class="badge badge-sm bg-gradient-danger">delete</a> --}}
                      </td>
                    </tr>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phonenumber</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle Registration Number</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Enrolled By</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date/Time</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

 <!--  Show more customer details modal -->
<!-- Modal -->
<div class="modal fade" id="customer-details" tabindex="-1" aria-labelledby="customer-details" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Phone Number</label></br>
          <p id="phonenumber" style="padding-left:5px;"></p>
        </div>

        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Id Number</label></br>
          <p  id="idnumber" style="padding-left:5px;"></p>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Email</label></br>
          <p id="email" style="padding-left:5px;"></p>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Gender</label></br>
          <p id="gender" style="padding-left:5px;"></p>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Rewards Available</label></br>
          <p id="rewards" style="padding-left:5px;"></p>
        </div>
        <div class="form-holder form-holder-2 mt-4 mb-4">
          <label for="regno">Approved By : </label></br>
          <p id="approved_by" style="padding-left:5px;"></p>
        </div>    
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </div>
      </div>
    </div>
  </div>
</div>

{{-- Edit customer details --}}
<!-- Modal -->
  <div class="modal fade" id="edit-customer-modal" tabindex="-1" aria-labelledby="edit-customer-modal" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
          <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
            <ul class="list-group" id="errorsul">
            </ul>
          </div>  
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-holder form-holder-2 mb-2">
              <label for="regno">First Name</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="first_name"  id="first_name">
            </div>  
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Last Name</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="last_name" id="last_name">
            </div>
            
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Phone Number</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="phone_number" id="phone_number" >
            </div>
  
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Id Number</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="id_number" id="id_number">
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Email</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="email" name="edit_email" id="edit_email" >
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Gender</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="edit_gender" id="edit_gender">
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Rewards Available</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="edit_rewards" id="edit_rewards" >
            </div>
            <div class="modal-footer">
            <input type="hidden" id="customerid" value="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="getcustomerdatabtn" style="background-color:#f9a14d; color:white;" type="button" class="btn">edit customer</button>
           </div>
          </div>
        </div>
      </div>
    </div> 

  <!--  enrollment status employees modal -->
  <form action="/set-enrollment-status" method="POST">
    @csrf
  <div class="modal fade" id="enrollment-status-modal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
          <ul class="list-group" id="errorsul">
          </ul>
        </div> 
        <div class="modal-header">
          <h5 class="modal-title" id="enrollment-status-modalLabel">Set Customer Enrollment Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="enrollment_status">Set Status</label></br>
            <select name="enrollment_status" id="enrollment_status" class="form-control">
                <option value="Accepted">Accept</option>
                <option value="Rejected">Reject</option>
            </select>          
          </div>
          <div id="enrollment_reason_div" style="display:none;" class="form-holder form-holder-2 mt-4 mb-4">
          <label for="enrollment_status_reason">Reason for Rejecting/Accepting</label></br>
            <textarea  name="enrollment_status_reason" id="enrollment_status_reason" style="width:100%; margin-bottom:20px; padding-left:0px;" rows="3"> </textarea>
        </div>
          <div class="modal-footer">
          <input type="hidden" name="enrollment_customerid" id="enrollment_customerid" value="">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" style="background-color:#f9a14d; color:white;"  class="btn">Set Status</button>
         </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
