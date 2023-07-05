@extends('staff.body')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Cooperate Customers</h6>
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
                        <div class="card-header pb-3" style="display:flex;  justify-content:space-between;">
                            <h6>Authorized Fuel Purchases</h6>
                            <button id="authorize_purchase_btn" class="btn-sm btn btn-success" style="background-color:#f9a14d;">Authorize Purchase</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="authrorized_purchases_table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Id Number</th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount Authorized</th>
                                            <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount Sold</th>
                                            <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Account Type</th>

                                            <th
                                            style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Company Name</th>
                                            <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Document</th>
                                             <th
                                             style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach( $authorized_purchases as $authorized_purchase)

                                            <tr>
                                                <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $authorized_purchase[0][0]->first_name }}   {{ $authorized_purchase[0][0]->last_name }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[0][0]->id_number }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[1][0]->vehicle_type }}  {{ $authorized_purchase[1][0]->vehicle_registration }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->amount }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->amount_sold ? $authorized_purchase[2]->amount_sold : 0 }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->payment_type }}</span>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->name }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="/assets/authorize_purchases/{{ $authorized_purchase[2]->document_url }}" download class="badge badge-sm bg-gradient-info">Download</a>
                                                  </td>
                                                @if( $authorized_purchase[2]->status == 'complete' )

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-success">{{ $authorized_purchase[2]->status }}</span>
                                                </td>

                                                @else

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                                </td>

                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Id Number</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Company Name</th>
                                             <th
                                                style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Document</th>
                                             <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
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

<!-- Modal -->
<form action="/staff-authorize-fuel-purchase" method="post" enctype="multipart/form-data">
    @csrf
   <div class="modal fade" id="authorize_purchase" tabindex="-1" aria-labelledby="authorize-purchase" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Authorize Fuel Purchase</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <div class="form-holder form-holder-2">
                <label for="card-type">Company Name</label>
                <select name="companies_id" id="companies_id" class="form-control">
                </select>
              </div>

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
               <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="number" name="amount"  id="amount" placeholder="">
             </div>
               <div class="form-check form-holder">
                   <input class="form-check-input" name="jaza_tank[]" type="checkbox" value="" id="jazaTank">
                   <label class="font-weight-bold form-check-label" for="jazaTank">
                       Jaza Tank
                   </label>
               </div>
             <div class="form-holder form-holder-2 mt-4 mb-4">
               <label for="payment_type">Account Type</label></br>
               <select name="payment_type" id="payment_type" class="form-control">
                   <option value="credit">Credit</option>
                   <option value="prepaid">Prepaid</option>
               </select>
           </div>
           <div class="form-group" >
            <label style="margin-left:0px; font-weight:bold;" for="picture">Document</label>
            <input type="file" class="form-control" name="authorize_purchase_document" id="authorize_purchase_document" >
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



