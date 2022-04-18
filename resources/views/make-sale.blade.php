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
	<link rel="stylesheet" type="text/css" href="/front-end/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="/front-end/css/style.css"/>
	<link rel="icon"  href="front-end/images/logo.jpg">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	 <div style="padding-left:20px; padding-top:20px;">		<img src="front-end/images/logo.jpg" width="50" height="50" alt="">
    </div>
	<div style="margin-top:-50px; text-align:center; padding-top:50px; width:100%; margin-bottom:20px;">
						<h3>Reedem Rewards and Enjoy Purchase</h3>

	</div>
    <div style="margin-top:-170px;" class="page-content">
		<div class="wizard-v1-content" style="border:solid #f9a14d 2px;">
			<div class="wizard-form">
		        <form class="form-register" id="form-register" action="#" method="post">
					<div style="text-align:center; margin-bottom:30px; margin-top:30px;">
						<div style="margin-top:10px; margin-left:10px; margin-right:10px; display:none;" class="alert alert-danger" id="errorz" role="alert">
							<ul class="list-group" id="errorsul">
							</ul>
						</div>  
					</div>
		        	<div  id="form-total">
		        		 <!-- SECTION 1 -->
                         <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-number">Step 4</span>
			            	<span class="step-text">View Rewards</span>
			            </h2>
			            <section class="main-section" >
			                <div class="inner"  id="display-details">
							
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">Customer ID/Phone*</label>
										<input type="text" id="id-number" style="height:55px;" placeholder="34643511" class="form-control" required>
									</div>
									<div class="form-holder form-holder-2">
										<button type="button" id="databtn" style="background-color:#f9a14d; border:0px; width:100%; height:55px; margin-top:40px;" class="btn btn-primary btn-lg btn-block">Get Info</button>
									</div>
								</div>
								<div id="cutomer-details" class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
									
											</tr>
											<tr class="space-row">
											
											</tr>
										
											<tr class="space-row">
											
											</tr>
											<tr class="space-row">
											
											</tr>
											<tr class="space-row">
												
											</tr>
											<tr class="space-row">
												
											</tr>
											<tr class="space-row">
												
											</tr>
											<tr class="space-row">
												
											</tr>
                                            <tr class="space-row">
											
											</tr>
										</tbody>
									</table>
								</div>
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
										<label for="card-type">Product</label>
										<select name="make" id="product" class="form-control">
											<option value="Diesel" selected>Diesel</option>
											<option value="Petrol">Petrol</option>
											
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname">Enter Amount (KES)</label>
										<input type="number" id="total_amount" placeholder="Enter Amount" class="form-control" id="firstname" name="firstname">
									</div>
								</div>
								@if($rewards_details[0]->status == 'enabled')
								<p style="color:white; ">Use Rewards*</p>
								<div class="form-row" style="padding-left:20px; margin-bottom:30px; margin-top:10px;">
									<div class="form-check" style="margin-right:20px;">
										<input class="usereward form-check-input" type="radio"  value="yes" name="usereward" checked>
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
											Yes
										</label>
									  </div>
									  <div class="form-check">
										<input class="usereward form-check-input" value="no"  type="radio" name="usereward"  >
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
										  No
										</label>
									  </div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname">Reward to Use (Ksh)</label>
										<input type="number"  placeholder="Enter Amount" class="form-control" id="rewards" name="firstname">
									</div>
								</div>
								@else
								<p style="color:white; display:none; ">Use Rewards*</p>
								<div class="form-row" style="display:none; padding-left:20px; margin-bottom:30px; margin-top:10px;">
									<div class="form-check" style="margin-right:20px;">
										<input class="usereward form-check-input" type="radio"  value="yes" name="usereward" checked>
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
											Yes
										</label>
									  </div>
									  <div class="form-check">
										<input class="usereward form-check-input" value="no"  type="radio" name="usereward"  >
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
										  No
										</label>
									  </div>
								</div>
								<div class="form-row" style="display:none;">
									<div class="form-holder form-holder-2">
										<label for="firstname">Reward to Use(Ksh)</label>
										<input type="number"  placeholder="Enter Amount" class="form-control" id="rewards" name="firstname">
									</div>
								</div>
								@endif
								<p style="margin-left:10px; margin-bottom:20px; margin-top:20px; font-weight:bold; color:white;">Amount Payable </p>
                                <div class="form-row" style="text-align:center;">
									<div class="form-holder">
									<button id="amountpayablebtn" type="button" style="font-size:16px; background-color:#f9a14d; border:0px; width:100%;  padding-top:20px; padding-bottom:20px;" class="btn btn-primary btn-lg btn-block">Calculate Amount Payable</button>
									</div>
								</div>
								<div class="form-row" style="margin-top:30px;">
									<div class="form-holder">
										<label for="password">Amount Payable (KSH)*</label>
										<input type="text" placeholder="Enter Amount" class="form-control" id="amount_payable" name="phonenumber"  >
									</div>
									<div class="form-holder">
										<label for="password">Amount Paid (KSH)*</label>
										<input type="text" placeholder="Enter Amount" class="form-control" id="amount_paid" name="phonenumber"  >
									</div>
								</div>
								<input type="hidden" name="reward_percentage" id="reward_percentage" value={{ $rewards_details[0]->percentage }}>
							</div>
			            </section>
			            <!-- SECTION 3 -->
                        <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-account"></i></span>
			            	<span class="step-number">Step 1</span>
			            	<span class="step-text">Print Receipt</span>
			            </h2>
                        <section>
			                <div class="inner">
			                	<h3>Receipt</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th style="border:0px;">First Name:</th>
												<td id="sales-firstname-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Last Name:</th>
												<td id="sales-lastname-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Phone Number:</th>
												<td id="sales-phonenumber-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">ID Number:</th>
												<td id="sales-idnumber-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Email:</th>
												<td id="sales-email-val" style="border:0px;"></td>
											</tr> 
											<tr class="space-row">
												<th style="border:0px;">Vehicle Category:</th>
												<td id="sales-vehicle-category" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Vehicle Registration:</th>
												<td id="sales-vehicle-registration" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Amount Payable:</th>
												<td id="sales-amount-payable" style="border:0px;"></td>
											</tr>
                                            <tr class="space-row">
												<th style="border:0px;">Amount Paid:</th>
												<td id="sales-amount-paid" style="border:0px;"></td>
											</tr>
                                            <tr class="space-row">
												<th style="border:0px;">Rewards Used:</th>
												<td id="sales-reward" style="border:0px;"></td>
											</tr>
                                            <tr class="space-row">
												<th style="border:0px;">Rewards Balance:</th>
												<td id="sales-reward-balance" style="border:0px;"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			            </section>
						
		        	</div>
		        </form>
			</div>
		</div>
	</div>
	
	<script src="/front-end/js/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="/front-end/js/jquery.steps.js"></script>
	<script src="/front-end/js/sales.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>