@extends('cooperate-customer.layout.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Accounts</h6>
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
                            <div class="card-body px-0 pt-0 pb-2" style="padding-left:30px;">
                                @if($account_type == 'credit')
                                <nav style="margin-left:20px; margin-top:30px;">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Credit</button>
                                    </div>
                                </nav>
                                <div style="margin-left:20px; margin-top:30px;" class="tab-content" id="nav-tabContent">
                                  {{-- credit account --}}
                                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="table-responsive p-0" style="margin-top:20px;">
                                        <table class="table align-items-center mb-0">
                                            <tbody>
                                                @foreach($accounts as $account)
                                                    @if($account->account_type == 'credit')
                                                    <tr>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xl" style="font-size:20px; font-weight:bold; color:#f9a14d;" >Account</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">STATUS</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ strtoupper($account->corporate_status) }}</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Number</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_number }}</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Type</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_type }}</span>
                                                        </td>
                                                    </tr>

                                                    @endif
                                                @endforeach         
                                             </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <tbody>   
                                                @foreach($accounts as $account)
                                                  @if($account->account_type == 'credit')
                                                    <tr style="border-top:2px solid grey;">
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0 font-weight:bold; color:#f9a14d;">Account Limit</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_limit }}</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0 font-weight:bold; color:#f9a14d;">Account Balance</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->account_balance }}</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0 font-weight:bold; color:#f9a14d;">Limit Utilized</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->limit_utilized }}</span>
                                                        </td>
                                                    </tr>
                                                  @endif
                                                @endforeach        
                                             </tbody>
                                        </table>
                                    </div>
                                    <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px">Payments</h6>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <thead style="border-top:2px solid grey;">
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Date</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Payment Mode</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Amount</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Reference</th>
                                                 
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Payment By
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>  
                                                @foreach($payments as $payment)
                                                    @if( $payment->account_type == 'credit')
                                                    <tr>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">13 April 2022</p>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $payment->payment_mode }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->amount_paid }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->reference_number }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->payed_by }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">completed</span>
                                                        </td>
                                                      </tr>
                                                    @endif
                                                @endforeach         
                                             </tbody>
                                        </table>
                                    </div>

                                    <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px; ">Fuel Collection</h6>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <thead style="border-top:2px solid grey;">
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Collection Date</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Collected By</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Employee ID</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Vehicle Registration</th>
                                                 
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Amount
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                    @foreach( $authorized_purchases as $authorized_purchase) 
                                                
                                       @if( $authorized_purchase[2]->payment_type == 'credit')
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->sales_date }}</span>
                                            </td>
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
                                            @if( $authorized_purchase[2]->status == 'complete' )

                                            <td class="align-middle text-center text-sm">
                                              <span class="badge badge-sm bg-gradient-success">received</span>
                                            </td>

                                            @else

                                            <td class="align-middle text-center text-sm">
                                              <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                            </td>

                                            @endif
                                        </tr>
                                        @endif
                                     @endforeach

                                             </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                                @elseif($account_type == 'prepaid')
                                <nav style="margin-left:20px; margin-top:30px;">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Prepaid</button>
                                    </div>
                                  </nav>
                                    <div style="margin-left:20px; margin-top:30px;" class="tab-content" id="nav-tabContent">
                                    {{-- prepaid --}}
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="table-responsive p-0" style="margin-top:20px;">
                                        <table class="table align-items-center mb-0">
                                            <tbody>           
                                                <tr>
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <span class="text-xl" style="font-size:20px; font-weight:bold;" >Account</span>
                                                    </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <tbody>   
                                                @foreach($accounts as $account)
                                                @if($account->account_type == 'prepaid')
                                                 <tr style="border-top:2px solid grey;">
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">STATUS</span>
                                                        <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ strtoupper($account->corporate_status) }}</span>
                                                    </td>
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Balance</span>
                                                        <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->account_balance }}</span>
                                                    </td>
                                
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Type</span>
                                                        <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_type }}</span>
                                                    </td>
                                                  </tr>
                                                @endif
                                              @endforeach         
                                             </tbody>
                                        </table>
                                    </div>
                                    <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px">Purchases</h6>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <thead style="border-top:2px solid grey;">
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Date</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Payment Mode</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Amount</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Reference</th>
                                                 
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Payment By
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>            
                                            @foreach($payments as $payment)
                                                @if( $payment->account_type == 'prepaid')
                                                <tr>
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $payment->payment_date }}</p>
                                                    </td>
                                                    <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                        <span class="text-secondary text-xs font-weight-bold">{{ $payment->payment_mode }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $payment->amount_paid }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $payment->reference_number }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $payment->payed_by }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">completed</span>
                                                    </td>
                                                  </tr>
                                                @endif
                                            @endforeach 
                                             </tbody>
                                        </table>
                                    </div>

                                    <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px; ">Fuel Collection</h6>
                                    <div class="table-responsive p-2">
                                        <table class="table align-items-center mb-0">
                                            <thead style="border-top:2px solid grey;">
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Collection Date</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Collected By</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Employee ID</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Vehicle Registration</th>
                                                 
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Amount
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $authorized_purchases as $authorized_purchase) 
                                                
                                                @if( $authorized_purchase[2]->payment_type == 'prepaid')
                                                 <tr>
                                                     <td class="align-middle text-center text-sm">
                                                         <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->sales_date }}</span>
                                                     </td>
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

                                                     @if( $authorized_purchase[2]->status == 'complete' )
     
                                                     <td class="align-middle text-center text-sm">
                                                       <span class="badge badge-sm bg-gradient-success">received</span>
                                                     </td>
     
                                                     @else
     
                                                     <td class="align-middle text-center text-sm">
                                                       <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                                     </td>
     
                                                     @endif
                                                 </tr>
                                                 @endif
                                              @endforeach
                                             </tbody>
                                        </table>
                                    </div>
                                </div>
                                  </div>
                                @else
                                <nav style="margin-left:20px; margin-top:30px;">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Prepaid</button>
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Credit</button>
                                    </div>
                                  </nav>
                                  <div style="margin-left:20px; margin-top:30px;" class="tab-content" id="nav-tabContent">
                                    
                                    
                                    {{-- prepaid --}}
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="table-responsive p-0" style="margin-top:20px;">
                                            <table class="table align-items-center mb-0">
                                                <tbody>           
                                                    <tr>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xl" style="font-size:20px; font-weight:bold;" >Account</span>
                                                        </td>
                                                      </tr>
                                                 </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <tbody>   
                                                    @foreach($accounts as $account)
                                                    @if($account->account_type == 'prepaid')
                                                     <tr style="border-top:2px solid grey;">
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">STATUS</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ strtoupper($account->corporate_status) }}</span>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Balance</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->account_balance }}</span>
                                                        </td>
                                    
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Type</span>
                                                            <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_type }}</span>
                                                        </td>
                                                      </tr>
                                                    @endif
                                                  @endforeach         
                                                 </tbody>
                                            </table>
                                        </div>
                                        <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px">Purchases</h6>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <thead style="border-top:2px solid grey;">
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Date</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Payment Mode</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Amount</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Reference</th>
                                                     
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Payment By
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>            
                                                @foreach($payments as $payment)
                                                    @if( $payment->account_type == 'prepaid')
                                                    <tr>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $payment->payment_date }}</p>
                                                        </td>
                                                        <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $payment->payment_mode }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->amount_paid }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->reference_number }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $payment->payed_by }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">completed</span>
                                                        </td>
                                                      </tr>
                                                    @endif
                                                @endforeach 
                                                 </tbody>
                                            </table>
                                        </div>

                                        <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px; ">Fuel Collection</h6>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <thead style="border-top:2px solid grey;">
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Collection Date</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Collected By</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Employee ID</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Vehicle Registration</th>
                                                     
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Amount
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach( $authorized_purchases as $authorized_purchase) 
                                                    
                                                    @if( $authorized_purchase[2]->payment_type == 'prepaid')
                                                     <tr>
                                                         <td class="align-middle text-center text-sm">
                                                             <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->sales_date }}</span>
                                                         </td>
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
 
                                                         @if( $authorized_purchase[2]->status == 'complete' )
         
                                                         <td class="align-middle text-center text-sm">
                                                           <span class="badge badge-sm bg-gradient-success">received</span>
                                                         </td>
         
                                                         @else
         
                                                         <td class="align-middle text-center text-sm">
                                                           <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                                         </td>
         
                                                         @endif
                                                     </tr>
                                                     @endif
                                                  @endforeach
                                                 </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- credit account --}}
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="table-responsive p-0" style="margin-top:20px;">
                                            <table class="table align-items-center mb-0">
                                                <tbody>
                                                    @foreach($accounts as $account)
                                                        @if($account->account_type == 'credit')
                                                        <tr>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xl" style="font-size:20px; font-weight:bold;" >Account</span>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">STATUS</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ strtoupper($account->corporate_status) }}</span>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Number</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_number }}</span>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Type</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_type }}</span>
                                                            </td>
                                                        </tr>

                                                        @endif
                                                    @endforeach         
                                                 </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <tbody>   
                                                    @foreach($accounts as $account)
                                                      @if($account->account_type == 'credit')
                                                        <tr style="border-top:2px solid grey;">
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Limit</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">{{ $account->account_limit }}</span>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Account Balance</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->account_balance }}</span>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-xs font-weight-bold mb-0" style="font-weight:bold; color:#f9a14d;">Limit Utilized</span>
                                                                <span style="margin-left:20px;" class="text-secondary text-xs font-weight-bold">KES {{ $account->limit_utilized }}</span>
                                                            </td>
                                                        </tr>
                                                      @endif
                                                    @endforeach        
                                                 </tbody>
                                            </table>
                                        </div>
                                        <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px">Payments</h6>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <thead style="border-top:2px solid grey;">
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Date</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Payment Mode</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Amount</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Reference</th>
                                                     
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Payment By
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    @foreach($payments as $payment)
                                                        @if( $payment->account_type == 'credit')
                                                        <tr>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <p class="text-xs font-weight-bold mb-0">13 April 2022</p>
                                                            </td>
                                                            <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                                <span class="text-secondary text-xs font-weight-bold">{{ $payment->payment_mode }}</span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $payment->amount_paid }}</span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $payment->reference_number }}</span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $payment->payed_by }}</span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">completed</span>
                                                            </td>
                                                          </tr>
                                                        @endif
                                                    @endforeach         
                                                 </tbody>
                                            </table>
                                        </div>

                                        <h6 style="margin-top:40px; margin-bottom:4px; margin-left:10px; ">Fuel Collection</h6>
                                        <div class="table-responsive p-2">
                                            <table class="table align-items-center mb-0">
                                                <thead style="border-top:2px solid grey;">
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Collection Date</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Collected By</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Employee ID</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Vehicle Registration</th>
                                                     
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Amount
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                        @foreach( $authorized_purchases as $authorized_purchase) 
                                                    
                                           @if( $authorized_purchase[2]->payment_type == 'credit')
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $authorized_purchase[2]->sales_date }}</span>
                                                </td>
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
                                                @if( $authorized_purchase[2]->status == 'complete' )

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-success">received</span>
                                                </td>

                                                @else

                                                <td class="align-middle text-center text-sm">
                                                  <span class="badge badge-sm bg-gradient-warning">{{ $authorized_purchase[2]->status }}</span>
                                                </td>

                                                @endif
                                            </tr>
                                            @endif
                                         @endforeach

                                                 </tbody>
                                            </table>
                                        </div>
                                    </div>
                                  </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
