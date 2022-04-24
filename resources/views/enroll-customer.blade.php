<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Enroll-Customer</title>
    <base href="{{ URL::to('/') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="/front-end/css/raleway-font.css">
	<link rel="stylesheet" type="text/css" href="/front-end/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="/front-end/css/style.css"/>
	<link rel="icon"  href="front-end/images/logo.jpg">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	 <div style="padding-left:20px; padding-top:20px;">		
		<img src="front-end/images/logo.jpg" width="50" height="50" alt="">
    </div>
    	<div style="margin-top:-50px; text-align:center; padding-top:50px; width:100%; margin-bottom:20px;">
						<h3>Enroll to Loyalty and start enjoying free Rewards</h3>

	</div>
    <div style="margin-top:-170px;" class="page-content">
		<div  id="" class="wizard-v1-content" style="border:solid #f9a14d 2px; position: relative;">
			<div id="progress_bar" style="justify-content:center; text-align:center;">
				<img id="progress" src="front-end/images/progress_bar.gif" style=" display:none; position: absolute; top:40%; left:40%; z-index:3; margin-left:auto; margin-right:auto; max-width:100px; max-height:100px;" alt="">									
			</div>

			<div class="wizard-form" >
		        <form class="form-register" id="form-register" action="#" method="post">
		        	<div id="form-total" >
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-account"></i></span>
			            	<span class="step-number">Step 1</span>
			            	<span class="step-text">Personal Infomation</span>
			            </h2>
			            <section >
			                <div class="inner" >
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="firstname">First Name*</label>
										<input type="text" placeholder="First Name" class="form-control" id="firstname" name="firstname" required>
									</div>
									<div class="form-holder form-holder-2">
										<label for="lastname">Last  Name*</label>
										<input type="text" placeholder="Last Name" class="form-control" id="lastname" name="lastname" required>
									</div>
								</div>

								<p style="color:white; ">Gender*</p>
								<div class="form-row" style="padding-left:20px; margin-bottom:50px; margin-top:10px;">
									<div class="form-check" style="margin-right:20px;">
										<input class="form-check-input" type="radio" value="male" name="gender" id="gender">
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
											Male
										</label>
									  </div>
									  <div class="form-check">
										<input class="form-check-input" value="female" type="radio" name="gender" id="gender" checked>
										<label style="color:white; font-weight:bold;" class="form-check-label" for="gender">
										  Female
										</label>
									  </div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label for="password">Phone Number*</label>
										<input type="number" placeholder="0722428401" class="form-control" id="phonenumber" name="phonenumber" required >
									</div>
									<div class="form-holder">
										<label for="confirm_password">ID Number*</label>
										<input type="number" placeholder="34643511" class="form-control" id="idnumber" name="idnumber" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="email">Email Address*</label>
										<input type="email" placeholder="Your Email" class="form-control" id="email" name="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
									</div>
								</div>
								
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-car"></i></span>
			            	<span class="step-number">Step 2</span>
			            	<span class="step-text">Vehicle Infomation</span>
			            </h2>
			            <section>
			                <div class="inner">
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="card-type">Vehicle Category</label>
										<select name="category" id="category" class="form-control">
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
									<div class="form-holder form-holder-2">
										<label for="card-type">Vehicle Type</label>
										<select name="type" id="type" class="form-control">
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
								</div>
								<div class="form-holder form-holder-2">
									<label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">Vehicle Registration Number*</label>
									<input type="text" placeholder="KDD001Z" class="form-control" id="regno" name="regno" required>
								</div>
								<div class="form-row row mt-3">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<p style="color:white; font-weight:bold; margin-bottom:30px;">Vehicle Picture</p>
                                        <img id="vehicle_image" src="front-end/images/car.jpg" style="max-width:100%; max-height:500px;" alt="">									
									</div>
								</div>
								<div class="form-row" style="margin-top:30px;">
									<div class="form-holder">
										<label class="custom-file-upload">
										<img id="camera" src="front-end/images/camera.png" style="max-width:50px; max-height:50px;" alt="">									
										 Take a Photo
										<input type="file" id="image" name="uploader" id="uploader"                               
										accept="image/*" 
										capture="camera" /></label>
										</div>
								</div>
							</div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-number">Step 3</span>
			            	<span class="step-text">Confirm Your Details</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<h3>Comfirm Details</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th style="border:0px;">First Name:</th>
												<td id="firstname-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Last Name:</th>
												<td id="lastname-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Gender:</th>
												<td id="gender-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Phone Number:</th>
												<td id="phonenumber-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">ID Number:</th>
												<td id="idnumber-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Email:</th>
												<td id="email-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Vehicle Category:</th>
												<td id="category-val" style="border:0px;"></td>
											</tr>
											<tr class="space-row">
												<th style="border:0px;">Vehicle Registration Number:</th>
												<td id="regno-val" style="border:0px;"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<p style="color:white; font-weight:bold; margin-bottom:15px;">Vehicle Picture</p>
									<img id="confirm-vehicle-image" src="front-end/images/car.jpg" style="max-width:100%; max-height:500px;" alt="">									
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
	<script src="/front-end/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>