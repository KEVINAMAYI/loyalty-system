<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wizard-v1</title>
    <base href="{{ URL::to('/') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="/front-end/css/raleway-font.css">
	<link rel="stylesheet" type="text/css" href="/front-end/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="/front-end/css/style.css"/>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	<div style=" text-align:center; padding-top:50px; width:100%; height:300px;">
		<img src="front-end/images/logo.jpg" width="200" height="200" alt="">
	</div>
    <div style="margin-top:-170px;" class="page-content">
		<div class="wizard-v1-content" style="border:solid #f9a14d 2px;">
			<div class="wizard-form">
		        <form class="form-register" id="form-register" action="#" method="post">
					<div style="text-align:center; margin-bottom:30px; margin-top:30px;">
						<h1>Reedem Rewards and Enjoy Purchase</h2>
					</div>
		        	<div  id="form-total">
		        		 <!-- SECTION 1 -->
                         <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-number">Step 4</span>
			            	<span class="step-text">View Rewards</span>
			            </h2>
			            <section >
			                <div class="inner">
								<div class="form-row">
									<p style="margin-left:10px; margin-bottom:20px; margin-top:20px; font-weight:bold; color:white;">Enter Customer/Driver ID </p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<input type="text" style="height:55px;" placeholder="ID Number (34643511)" class="form-control" id="firstname" name="firstname" required>
									</div>
									<div class="form-holder form-holder-2">
										<button type="button" style="background-color:#f9a14d; border:0px; width:100%; height:55px;" class="btn btn-primary btn-lg btn-block">Get Info</button>
									</div>
								</div>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>First Name:</th>
												<td id="firstname-val">Kevin</td>
											</tr>
											<tr class="space-row">
												<th>Last Name:</th>
												<td id="lastname-val">Amayi</td>
											</tr>
										
											<tr class="space-row">
												<th>Phone Number:</th>
												<td id="phonenumber-val">0795704301</td>
											</tr>
											<tr class="space-row">
												<th>ID Number:</th>
												<td id="idnumber-val">34643511</td>
											</tr>
											<tr class="space-row">
												<th>Email:</th>
												<td id="email-val">kevinamayi20@gmail.com</td>
											</tr>
											<tr class="space-row">
												<th>Vehicle Make:</th>
												<td id="make-val">Toyota</td>
											</tr>
											<tr class="space-row">
												<th>Vehicle Model:</th>
												<td id="model-val">Morano</td>
											</tr>
											<tr class="space-row">
												<th>Vehicle Registration Number:</th>
												<td id="regno-val">KAG 453</td>
											</tr>
                                            <tr class="space-row">
												<th>Rewards Available</th>
												<td id="regno-val">KSH 5000</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<p style="color:white; font-weight:bold; margin-bottom:15px;">Vehicle Picture</p>
									<img src="front-end/images/car.jpg" style="max-width:100%; max-height:500px;" alt="">									
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
										<select name="make" id="make" class="form-control">
											<option value="" selected>Diesel</option>
											<option value="Honda">Petrol</option>
											<option value="Mitsubishi">Lead</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname">Total Amount*</label>
										<input type="text" placeholder="KSH 40000" class="form-control" id="firstname" name="firstname" required>
									</div>
								</div>
								<p style="color:white; ">Use Rewards*</p>
								<div class="form-row" style="padding-left:20px; margin-bottom:30px; margin-top:10px;">
									<div class="form-check" style="margin-right:20px;">
										<input class="form-check-input" type="radio" value="male" name="gender" id="gender">
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
											Yes
										</label>
									  </div>
									  <div class="form-check">
										<input class="form-check-input" value="female" type="radio" name="gender" id="gender" checked>
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
										  No
										</label>
									  </div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname">Reward to Use*</label>
										<input type="text" placeholder="KSH 40000" class="form-control" id="firstname" name="firstname" required>
									</div>
								</div>
								
								<p style="margin-left:10px; margin-bottom:20px; margin-top:20px; font-weight:bold; color:white;">Total Amount - Rewards ( KSH 400 ) </p>
                                <div class="form-row" style="text-align:center;">
									<div class="form-holder">
									<button type="button" style="background-color:#f9a14d; border:0px; width:100%; height:55px;" class="btn btn-primary btn-lg btn-block">Calculate Amount Payable</button>
									</div>
								</div>
								<div class="form-row" style="margin-top:30px;">
									<div class="form-holder">
										<label for="password">Amount Payable*</label>
										<input type="text" placeholder="0722428401" class="form-control" id="phonenumber" name="phonenumber" required >
									</div>
									<div class="form-holder">
										<label for="password">Amount Paid*</label>
										<input type="text" placeholder="0722428401" class="form-control" id="phonenumber" name="phonenumber" required >
									</div>
								</div>
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
												<th>First Name:</th>
												<td id="firstname-val">Kevin</td>
											</tr>
											<tr class="space-row">
												<th>Last Name:</th>
												<td id="lastname-val">Amayi</td>
											</tr>
											<!-- <tr class="space-row">
												<th>Gender:</th>
												<td id="gender-val"></td>
											</tr> -->
											<tr class="space-row">
												<th>Phone Number:</th>
												<td id="phonenumber-val">0795704301</td>
											</tr>
											<tr class="space-row">
												<th>ID Number:</th>
												<td id="idnumber-val">34643511</td>
											</tr>
											<!-- <tr class="space-row">
												<th>Email:</th>
												<td id="email-val"></td>
											</tr> -->
											<!-- <tr class="space-row">
												<th>Vehicle Make:</th>
												<td id="make-val"></td>
											</tr> -->
											<!-- <tr class="space-row">
												<th>Vehicle Model:</th>
												<td id="model-val"></td>
											</tr> -->
											<tr class="space-row">
												<th>Amount Payable:</th>
												<td id="regno-val">8000</td>
											</tr>
                                            <tr class="space-row">
												<th>Amount Paid:</th>
												<td id="regno-val">7000</td>
											</tr>
                                            <tr class="space-row">
												<th>Rewards Used:</th>
												<td id="regno-val">1000</td>
											</tr>
                                            <tr class="space-row">
												<th>Rewards Balance:</th>
												<td id="regno-val">4700</td>
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
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="/front-end/js/jquery.steps.js"></script>
	<script src="/front-end/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>