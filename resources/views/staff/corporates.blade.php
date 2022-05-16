@extends('staff.layouts.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  
  <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Registered Corporates</h6>
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
            <h6>Registered Corporates</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Credit Limit(KES)</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prepaid Amount(KES)</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Discount Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo</th> --}}
                  </tr>
                </thead>
                <tbody>

                  @foreach ( $corporates_accounts as $corporate_account)    
                    <tr>
                      <td style="padding-left:30px;" class="align-middle text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name; }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->account_type }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->account_limit }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->amount_payable ? $corporate_account->amount_payable : 0  }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->discount }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <span id="{{ $corporate_account->organization_id }}" account_name="{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name; }}" account_type="{{ $corporate_account->account_type }}" account_number={{ $corporate_account->account_number }} account_balance={{ $corporate_account->account_balance }} style="background-color:#4881c0; cursor:pointer;"  class="managecorporatebtn badge badge-sm">Manage</span>
                      <span org_id="{{ $corporate_account->organization_id }}" account_name="{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name; }}" account_type="{{ $corporate_account->account_type }}" class="show_purchase_payment_btn badge badge-sm bg-gradient-danger" account_number={{ $corporate_account->account_number }} account_balance={{ $corporate_account->account_balance }} style="cursor:pointer;">Payment/Purchase</span>
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



 <!--  Manage corporates modal -->
<form class="form-register" method="POST" action="/set-credit-limit">
  @csrf
  <div class="modal fade" id="manage-corporate" tabindex="-1" aria-labelledby="manage-corporate" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Manage Corporate Customer</h5>
            <button type="button" style="color:black;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10006</button>
          </div>
          <div class="modal-body">
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Organization Name</label></br>
                <p class="acc_name_disp" style="padding-left:5px;"></p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Account Type</label></br>
                <p class="acc_name_type" style="padding-left:5px;"></p>
              </div>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
                <label for="regno">Account Number</label></br>
                <input class="acc_number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="account_number" id="account_number"  placeholder="7770169016805">
            </div> 
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Credit Limit Amount</label></br>
              <input  style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="account_limit" id="account_limit" placeholder="0">
            </div>

            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Discount Amount</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" id="discount" name="discount"  placeholder="2.00">
            </div>
            <div class="modal-footer">
              <input type="hidden" class="corporate_main_id" name="corporate_id" value="">
              <input type="hidden" class="corporate_account_type" name="account_type"  value="">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Submit</button>
           </div>
          </div>
        </div>
      </div>
    </div>
  </form>


  
 <!--  Add Payment/Purchase modal -->
<form class="form-register" method="POST" action="/make-payment-or-purchase">
  @csrf
  <div class="modal fade" id="make-payment-model" tabindex="-1" aria-labelledby="manage-corporate-payment" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
            <button type="button" style="color:black;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10006</button>
          </div>
          <div class="modal-body">
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Organization Name</label></br>
                <p class="acc_name_disp" style="padding-left:5px;"></p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Account Type</label></br>
                <p class="acc_name_type" style="padding-left:5px;"></p>
              </div>
            </div>
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-2">
                <label for="regno">Account Number</label></br>
                <p class="acc_no_disp" style="padding-left:5px;">7770169016805</p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-2">
                <label for="regno">Current Balance</label></br>
                <p class="acc_bal_type" style="padding-left:5px;">-10000</p>
              </div>
            </div> 
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Amount Paid</label></br>
              <input type="number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="amount_paid" id="amount_paid"  placeholder="100000" required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Paid By</label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="paid_by" id="paid_by"  placeholder="Hassan Kassim" required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Payment Date</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="date" name="payment_date" id="payment_date" placeholder="-100000" required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Mode of Payment</label></br>
              <select name="payment_mode" id="payment_mode" class="form-control" required>
                <option value="Cheque">Cheque</option>
                <option value="Cash">Cash</option>
                <option value="Mpesa">Mpesa</option>
            </select>            
           </div>
           <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Reference Number</label></br>
            <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="reference_number" id="reference_number"  placeholder="QAWSD3433" required>
          </div>
           <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Payment details</label></br>
            <textarea name="payment_details" id="payment_details" style="width:100%; padding-left:0px;" rows="3" required>  Cheque 3025
  Absa Bank
  Date 02-05-2022              
            </textarea>            
         </div>
            <div class="modal-footer">
              <input type="hidden" class="corporate_main_id" name="corporate_id" value="">
              <input type="hidden" class="corporate_account_type" name="account_type"  value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Submit</button>
           </div>
          </div>
        </div>
      </div>
    </div>
  </form>

@endsection
