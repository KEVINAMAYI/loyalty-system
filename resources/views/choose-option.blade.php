<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
    <base href="{{ URL::to('/') }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/front-end/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/front-end/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/front-end/css/util.css">
	<link rel="stylesheet" type="text/css" href="/front-end/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-logo">
						<img src="front-end/images/logo.jpg" width="70" height="70">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						ENROLL NOW AND START ENJOYING FREE REWARDS
					</span>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div> -->

					

					<div class="container-login100-form-btn">
						<a href="/enroll-customer" class="login100-form-btn">
                            Enroll
                        </a>
					</div>

                    <div class="text-white text-center mt-4">
                        Already Enrolled ?
                     </div>

                    <div class="container-login100-form-btn mt-4">
						<a href="/make-sale" class="login100-form-btn">
							Continue to Sales
						</a>
					</div>

					<div class="text-white text-center mt-4">
                        OR ?
                     </div>

					<div class="container-login100-form-btn mt-4">
						<a href="/staff-dashboard" class="login100-form-btn">
							Visit Staff Portal
						</a>
					</div>
					<div class="text-white text-center mt-4">
                        OR ?
                     </div>

					<div class="container-login100-form-btn mt-4">
						<a href="index.html" class="login100-form-btn">
							Log Out
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/front-end/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/vendor/bootstrap/js/popper.js"></script>
	<script src="/front-end/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/vendor/daterangepicker/moment.min.js"></script>
	<script src="/front-end/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/front-end/js/index.js"></script>

</body>
</html>