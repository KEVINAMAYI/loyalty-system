<!DOCTYPE html>
<html lang="en">
<head>
	<title>Choose Option</title>
    <base href="{{ URL::to('/') }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
   <link rel="icon"  href="front-end/images/logo.jpg">
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
		<div class="container-login100" style="background-image: url('front-end/images/bg-01.jpg');">
			<div class="wrap-login100">
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

					 @if(Auth::user()->major_role == 'Admin')

					<div class="container-login100-form-btn mt-4">
						<a href="/staff-dashboard" class="login100-form-btn">
							Visit Staff Portal
						</a>
					</div>
					<div class="text-white text-center mt-4">
                        OR ?
                     </div>
					 
					 @endif

					<div class="container-login100-form-btn mt-4">
						
						<a class="login100-form-btn" href="{{ route('logout') }}"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
							Log Out
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
						</form>
					</div>
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