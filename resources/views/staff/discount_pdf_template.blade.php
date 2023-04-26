<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="staff/assets/img/apple-icon.png">
    <link rel="icon"  href="front-end/images/logo.jpg">
    <title>
        Staff Dashboard
    </title>
    <base href="{{ URL::to('/') }}">

    <link id="pagestyle" href="staff/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="staff/assets/js/main.js"></script>

</head>
<body class="g-sidenav-show  bg-gray-100">

<div class="container">
    <div class="row  mt-2 text-center">
        <div class="col-12 mt-1">
            <img src="staff/assets/img/logo.jpg" style="border-radius:100%;" width="90" height="90">
        </div><div class="col-12 mt-1">
            <p style="font-weight:bold">EPREN PETROL STATION</p>
        </div>
        <div class="row">
            <div class="col-3" style="margin-top:-19px;">
                <p style="font-weight:bold">DISCOUNT NO : {{ $discount->id }} </p>
            </div>
            <div class="col-6" style="margin-top:-19px;">
                <p style="font-weight:bold">CASH REDEMPTION PAYMENT VOUCHER</p>
            </div>
            <div class="col-3" style="margin-top:-19px;">
                <p style="font-weight:bold">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Customer Name : </span><span> {{ $customer->first_name.' '.$customer->last_name }}</span></p>
        </div>
        <div class="col-6">
            <p><span style="font-weight:bold;">Customer Phone :</span> <span>{{ $customer->phone_number }}</span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Vehicle Registration :</span><span> {{ App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') != null ? App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') : 'No Vehicle Assigned' }} </span></p>
        </div>
        <div class="col-6">
            <p ><span style="font-weight:bold;">Amount (KES) : </span> <span style="margin-left:30px;"> {{ $discount->amount }} </span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Customer :</span> <span> {{ $customer->first_name.' '.$customer->last_name }} </span></p>
        </div>
        <div class="col-6">
            <p ><span style="font-weight:bold;">Checked By :</span> <span> {{ $discount->redeemed_by }}</span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <label for="sign1" style="margin-bottom:30px;">Signature</label></br>
            <p id="sign1" >___________________________</p>
        </div>
        <div class="col-6">
            <label for="sign2" style="margin-bottom:30px;">Signature</label></br>
            <p id="sign2" >___________________________</p>
        </div>
    </div>
</div>


<div class="container">
    <div class="row  mt-2 text-center">
        <div class="col-12 mt-1">
            <img src="staff/assets/img/logo.jpg" style="border-radius:100%;" width="90" height="90">
        </div><div class="col-12 mt-1">
            <p style="font-weight:bold">EPREN PETROL STATION</p>
        </div>
        <div class="row">
            <div class="col-3" style="margin-top:-19px;">
                <p style="font-weight:bold">DISCOUNT NO : {{ $discount->id }} </p>
            </div>
            <div class="col-6" style="margin-top:-19px;">
                <p style="font-weight:bold">CASH REDEMPTION PAYMENT VOUCHER</p>
            </div>
            <div class="col-3" style="margin-top:-19px;">
                <p style="font-weight:bold">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Customer Name : </span><span> {{ $customer->first_name.' '.$customer->last_name }}</span></p>
        </div>
        <div class="col-6">
            <p><span style="font-weight:bold;">Customer Phone :</span> <span>{{ $customer->phone_number }}</span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Vehicle Registration :</span><span> {{ App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') != null ? App\Models\Vehicle::where('customer_id', '=', $customer->id)->value('vehicle_registration') : 'No Vehicle Assigned' }} </span></p>
        </div>
        <div class="col-6">
            <p ><span style="font-weight:bold;">Amount (KES) : </span> <span style="margin-left:30px;"> {{ $discount->amount }} </span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p ><span style="font-weight:bold;">Customer :</span> <span> {{ $customer->first_name.' '.$customer->last_name }} </span></p>
        </div>
        <div class="col-6">
            <p ><span style="font-weight:bold;">Checked By :</span> <span> {{ $discount->redeemed_by }}</span></p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <label for="sign1" style="margin-bottom:30px;">Signature</label></br>
            <p id="sign1" >___________________________</p>
        </div>
        <div class="col-6">
            <label for="sign2" style="margin-bottom:30px;">Signature</label></br>
            <p id="sign2" >___________________________</p>
        </div>
    </div>
</div>




<script src="staff/assets/js/core/bootstrap.min.js"></script>
<script src="/front-end/vendor/jquery/jquery-3.2.1.min.js"></script>

<script>

   window.onload = function() {
       window.print();
       setTimeout(function () {
           window.close();
           location.href = "/discounts";
           }, 100);
       }


</script>
</body>
