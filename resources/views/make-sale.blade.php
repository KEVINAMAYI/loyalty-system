<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Make Sale</title>
    <base href="{{ URL::to('/') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="/front-end/css/raleway-font.css">
    <link rel="stylesheet" type="text/css"
          href="/front-end/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="/front-end/css/style.css" />
    <link rel="icon" href="front-end/images/logo.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .actions > ul > li{
            width:120px;
            height:50px;
            border-radius:0px;
        }
    </style>
</head>

<body>
<div style="padding-left:20px; padding-top:20px;"> <img src="front-end/images/logo.jpg" width="50"
                                                        height="50" alt="">
</div>
<div style="margin-top:-50px; text-align:center; padding-top:50px; width:100%; margin-bottom:20px;">
    <h3>Purchase and Redeem Rewards</h3>

</div>
<div style="margin-top:-170px;" class="page-content">
    <div class="wizard-v1-content" style="border:solid #f9a14d 2px; position: relative;">
        <div id="progress_bar" style="justify-content:center; text-align:center;">
            <img id="progress" src="front-end/images/progress_bar.gif"
                 style=" display:none; position: absolute; top:40%; left:40%; z-index:3; margin-left:auto; margin-right:auto; max-width:100px; max-height:100px;"
                 alt="">
        </div>
        <div class="wizard-form">
            <form class="form-register" id="form-register" action="#" method="post">
                <div id="form-total">
                    <!-- SECTION 1 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
                        <span class="step-number">Step 1</span>
                        <span class="step-text">Customer</span>
                    </h2>
                    <section class="main-section">
                        <div class="inner" id="display-details">

                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <label for="firstname"
                                           style="color:white; font-weight:bold; margin-bottom:10px;">ID/Phone/Vehicle
                                        Registration*</label>
                                    <input class="typeahead" type="text" id="id-number" style="height:55px;"
                                           placeholder="" class="form-control" required>
                                </div>
                                <div id="get_data_btn" class="form-holder form-holder-2">
                                    <button type="button" id="databtn"
                                            style="background-color:#f9a14d; border:0px; width:100%; height:55px; margin-top:40px;"
                                            class="btn btn-primary btn-lg btn-block">Get Info</button>
                                </div>
                            </div>
                            {{-- <div id="cutomer-details" class="form-row table-responsive" style="height:0px; background-color:yellow">
                            </div> --}}
                            <div class="col-lg-12 col-md-12 col-sm-12">

                            </div>
                        </div>
                    </section>
                    <!-- SECTION 2 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-car"></i></span>
                        <span class="step-number">Step 2</span>
                        <span class="step-text">Sales Infomation</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <label for="card-type">Vehicle Fuel Type</label>
                                    <input type="text" id="fuel_type_label" value="Petrol" placeholder="Petrol"
                                           class="form-control" readonly>
                                    <input type="hidden" id="product" value="107.5" placeholder="Petrol"
                                           class="form-control" readonly>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <label for="firstname">Enter Amount (KES)</label>
                                    <input type="number" id="total_amount" placeholder="Enter Amount"
                                           class="form-control" required>
                                </div>

                                <div class="form-holder form-holder-2 text-left">
                                    <label for="firstname">Litres</label>
                                    <input type="number" id="liters_val" class="form-control" required>
                                </div>
                            </div>
                            <p
                                style="margin-left:10px; margin-bottom:20px; margin-top:20px; font-weight:bold; color:white;">
                                Amount Payable </p>
                            <div class="form-row" style="text-align:center;">
                                <div class="form-holder">
                                    <button id="amountpayablebtn" type="button"
                                            style="font-size:16px; background-color:#f9a14d; border:0px; width:100%;  padding-top:20px; padding-bottom:20px;"
                                            class="btn btn-primary btn-lg btn-block">Calculate Amount Payable</button>
                                </div>
                            </div>
                            <div class="form-row" style="margin-top:30px;">
                                <div class="form-holder">
                                    <label for="password">Amount Payable (KSH)*</label>
                                    <input type="text" placeholder="Enter Amount" class="form-control"
                                           id="amount_payable"  readonly required>
                                </div>
                                <div class="form-holder">
                                    <label for="password">Amount Paid (KSH)*</label>
                                    <input type="text" placeholder="Enter Amount" class="form-control"
                                           id="amount_paid"  required>
                                </div>
                            </div>

                            {{-- pump image --}}
                            <div style="margin-left:-2px; margin-bottom:30px;" class="form-holder form-holder-2 mt-2">
                                <label style="font-size:17px; color:white; margin-bottom:7px;" for="pump">Step 1: Pump Number</label>
                                <select name="pump" id="pump" class="form-control">
                                    <option value="pump 1">Pump 1</option>
                                    <option value="pump 2">Pump 2</option>
                                    <option value="pump 3">Pump 3</option>
                                    <option value="pump 4">Pump 4</option>
                                    <option value="pump 5">Pump 5</option>
                                    <option value="pump 6">Pump 6</option>
                                </select>
                            </div>

                            {{-- pump Side --}}
                            <div style="margin-left:-2px; margin-bottom:30px;" class="form-holder form-holder-2">
                                <label style="font-size:17px; color:white; margin-bottom:7px;" for="pump">Step 2: Pump Side</label>
                                <select name="pump_side" id="pump_side" class="form-control">
                                    <option value="Side 1">Side 1</option>
                                    <option value="Side 2">Side 2</option>
                                </select>
                            </div>

                            {{-- vehicle image --}}
                            <div class="form-holder">
                                <img id="vehicle_image" loading="lazy" class="img-fluid img-thumbnail"
                                     src="" style="border:2px solid white; width:200px; height:200px;"
                                     alt="Vehicle Photo">
                            </div>
                            <div class="form-row" style="margin-top:30px;">
                                <div style="margin-left:0px; padding-left:0px; padding-top:5px;"
                                     class="form-holder">
                                    <label class="custom-file-upload">
                                        <img id="camera" src="front-end/images/camera.png"
                                             style="max-width:50px; max-height:50px;" alt="">
                                        <input type="file" id="image" name="image" accept="image/*"
                                               capture="camera" />
                                        Take Photo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- SECTION 3 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-account"></i></span>
                        <span class="step-number">Step 3</span>
                        <span class="step-text">Print Receipt</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <h3>Receipt</h3>
                            <div class="card"
                                 style="width: 100%; margin-bottom:25px; color:white; background-color:#2f8be0;">
                                <div class="card-body">

                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Name :</span>
                                        <span id="sales-name-val"> </span>
                                    </p>

                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Phone Number :</span>
                                        <span id="sales-phonenumber-val"></span>
                                    </p>

                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Vehicle Registration :</span>
                                        <span id="sales-vehicle-registration"></span>
                                    </p>

                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Amount Paid:</span>
                                        <span id="sales-amount-paid"></span>
                                    </p>
                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Litres Sold:</span>
                                        <span id="sales-litres-bought"></span>
                                    </p>

                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Rewards Used:</span>
                                        <span id="sales-reward"></span>
                                    </p>
                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Rewards Earned:</span>
                                        <span id="sales-rewards-awarded"></span>
                                    </p>
                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Date/Time:</span>
                                        <span id="sales-date-time"></span>
                                    </p>
                                    <p class="card-text">
                                            <span style="color:white; font-weight:bold;"
                                                  class="card-subtitle mb-2 text-white">Served By:</span>
                                        <span id="sales-person-name">{{ auth()->user()->name }}</span>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </section>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- vehicle modal -->
<!-- Modal -->
<form action="">
    @csrf
    <div class="modal fade" id="add_vehicle_modal" tabindex="-1" aria-labelledby="vehicles"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-holder form-holder-2 mt-2">
                        <label for="vehicle_category">Vehicle Category</label>
                        <select name="vehicle_category" id="vehicle_category" class="form-control">
                            <option value="">Select...</option>
                            <option value="sedan">Sedan</option>
                            <option value="coupe">Coupe</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="station-wagon">Station Wagon</option>
                            <option value="suv">SUV</option>
                            <option value="pick-up">Pick up</option>
                            <option value="van">Van</option>
                            <option value="mini-van">Mini Van</option>
                            <option value="wagon">Wagon</option>
                            <option value="convertible">Convertible</option>
                            <option value="bus">Bus</option>
                            <option value="truck">Truck</option>
                        </select>
                    </div>

                    <div class="form-holder form-holder-2 mt-2">
                        <label for="vehicle_type">Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" class="form-control">
                            <option value="">Select...</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="chevrolet">Chevrolet</option>
                            <option value="chrysler">Chrysler</option>
                            <option value="citroen">Citroën</option>
                            <option value="daihatsu">Daihatsu</option>
                            <option value="eicher">EICHER</option>
                            <option value="ford">Ford</option>
                            <option value="hino">HINO</option>
                            <option value="honda">Honda</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="jaguar">Jaguar</option>
                            <option value="jeep">Jeep</option>
                            <option value="kia">Kia</option>
                            <option value="land rover">Land Rover</option>
                            <option value="lexus">Lexus</option>
                            <option value="man">Man</option>
                            <option value="maserati">Maserati</option>
                            <option value="mazda">Mazda</option>
                            <option value="mercedes-benz">Mercedes-Benz</option>
                            <option value="mini">MINI</option>
                            <option value="mitsubishi">Mitsubishi</option>
                            <option value="mobius">MOBIUS</option>
                            <option value="nissan">Nissan</option>
                            <option value="peugout">Peugeot</option>
                            <option value="porsche">Porsche</option>
                            <option value="range rover">Range Rover</option>
                            <option value="subaru">Subaru</option>
                            <option value="suzuki">Suzuki</option>
                            <option value="toyota">Toyota</option>
                            <option value="volkswagen">Volkswagen</option>
                            <option value="volvo">Volvo</option>

                        </select>
                    </div>
                    <div class="mt-2 form-holder form-holder-2">
                        <label for="firstname" style="color:black;">Vehicle Fuel Type*</label>
                        <select name="fuel_type" id="fuel_type" class="form-control">
                            <option value="Diesel">Diesel</option>
                            <option value="Petrol">Petrol</option>
                        </select>
                    </div>
                    <div class="form-holder form-holder-2 mt-2 mb-2">
                        <label for="regno">Vehicle Registration</label></br>
                        <input
                            style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                            type="text" name="vehicle_registration" id="vehicle_registration"
                            placeholder="Enter Number Plate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitvehiclebtn" style="background-color:#f9a14d; color:white;"
                            type="button" class="btn">Add Vehicle</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Reedem Reward Modal -->
<div class="modal" id="discount-details-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Redeem Rewards</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-holder form-holder-2 mt-4 mb-4">
                    <label for="redeemable_rewards">Rewards (Total Rewards)</label></br>
                    <p id="redeemable_rewards" style="padding-left:5px;"></p>
                </div>
                <div class="form-holder form-holder-2 mt-4 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="Discount">Enter Rewards To Redeem</label></br>
                        </div>
                        <div class="col-6">
                            <input
                                style="width:90%; margin-right:10%; margin-left:-40px; padding:5px;  border-color: black; border-width:1px; "
                                type="number" name="discount_amount" id="discount_amount" required>
                        </div>
                    </div>

                </div>
                {{-- pump image --}}
                <div style="margin-left:-2px; margin-bottom:15px;" class="form-holder form-holder-2 mt-2">
                    <label style="font-size:17px; color:black; margin-bottom:7px;" for="pump">Pump Number</label>
                    <select name="pump_reward" id="pump_reward" class="form-control">
                        <option value="pump 1">Pump 1</option>
                        <option value="pump 2">Pump 2</option>
                        <option value="pump 3">Pump 3</option>
                        <option value="pump 4">Pump 4</option>
                        <option value="pump 5">Pump 5</option>
                        <option value="pump 6">Pump 6</option>
                    </select>
                </div>

                {{-- pump Side --}}
                <div style="margin-left:-2px; margin-bottom:15px;" class="form-holder form-holder-2">
                    <label style="font-size:17px; color:black;  margin-bottom:7px;" for="pump">Pump Side</label>
                    <select name="pump_side_reward" id="pump_side_reward" class="form-control">
                        <option value="Side 1">Side 1</option>
                        <option value="Side 2">Side 2</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="customer_id" value="">
                <input type="hidden" name="csa" id="csa" value="{{ auth()->user()->name }}">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submit_disc_btn" class="btn btn-primary">Proceed</button>
            </div>
        </div>
    </div>
</div>


<script src="/front-end/js/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="/front-end/js/jquery.steps.js"></script>
<script src="/front-end/js/sales.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

</body>

</html>
