@extends('cooperate-customer.layout.body')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Authorize Fuel Purchase</h6>
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

        <button id="authorizepurchasemodelbtn" type="button" style="background-color:#f9a14d;" class="btn btn-primary btn-md" ><i class="fa-solid fa-lock-open"></i></i>
            <span style="margin-left:5px;">Authorize Fuel Purchase</span></button>

        <div class="container-fluid py-4">
    

            <div class="row">
            
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                          <div class="row">
                            <div class="col-md-6">
                              <h6>Authorized Purchases</h6>
                            </div>
                            <div class="col-md-6" style="display:flex; justify-content:right;">
                              <button  id="exportauthorizedpurchasesbtn" type="button" style="max-width:250px; background-color:#f9a14d;" class="btn btn-primary btn-md" ><i class="fa-solid fa-file"></i></i>
                              <span style="margin-left:5px;">Export to PDF</span></button>
                            </div>
                          </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="authorizationtable">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom:1px solid" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Employee_ID</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount</th>
                                             <th
                                             style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                            style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach( $authorized_purchases as $authorized_purchase) 

                                            <tr>
                                                <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $authorized_purchase[0][0]->first_name }}   {{ $authorized_purchase[0][0]->last_name }}</p>
                                                </td>
                                                <td class="align-middle text-left text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[0][0]->id_number }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[1][0]->vehicle_type }}  {{ $authorized_purchase[1][0]->vehicle_registration }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->amount }}</span>
                                                </td>
                                             

                                                @if( $authorized_purchase[2]->status == 'complete' )

                                                <td style="color:green; font-weight:bold;" class="align-middle text-center text-sm">
                                                 {{ $authorized_purchase[2]->status }}
                                                </td>

                                                @else

                                                <td style="color:orange; font-weight:bold;" class="align-middle text-center  text-sm">
                                                  {{ $authorized_purchase[2]->status }}
                                                </td>

                                                @endif
                                                
                                                <td class="align-middle text-center text-sm">
                                                    <a href="/delete-authorized-purchase/{{ $authorized_purchase[2]->id }}" class="badge badge-sm bg-gradient-danger">delete</a>
                                                </td>
                                            </tr>

                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Employee_ID</th>
                                                <th
                                                 class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Vehicle</th>
                                                <th
                                                 class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Amount</th>
                                                 <th
                                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status
                                                </th>
                                                <th
                                                 class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- reward modal -->
<!-- Modal -->
<form action="/authorize-fuel-purchase" method="post">
 @csrf
<div class="modal fade" id="authorize-purchase" tabindex="-1" aria-labelledby="authorize-purchase" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Authorize Fuel Purchase</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-holder form-holder-2">
            <label for="card-type">Employee</label>
            <select name="employees" id="employees" class="form-control">
            </select>
          </div>

          <div class="form-holder form-holder-2 mt-4">
            <label for="card-type">Vehicle</label>
            <select name="vehicles" id="vehicles" class="form-control">
            </select>
          </div>

          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Amount</label></br>
            <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="amount"  id="amount" placeholder="33,000">
          </div>

          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="payment_type">Account Type</label></br>
            <select name="payment_type" id="payment_type" class="form-control">
                <option value="credit">Credit</option>
                <option value="prepaid">Prepaid</option>
            </select>          
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Authorize Fuel Purchase</button>
        </div>
      </div>
    </div>
  </div>
</form>


@endsection
