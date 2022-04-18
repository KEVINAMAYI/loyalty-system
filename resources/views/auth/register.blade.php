<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon"  href="front-end/images/logo.jpg">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="..//vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/img/bg-01.jpg');">
			<div class="wrap-login100">

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

				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					@csrf

                    <span class="login100-form-logo">
						<img src="../assets/img/logo.jpg" width="70" height="70">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Register
					</span>

    
					<div class="wrap-input100 validate-input" data-validate = "Enter CompanyName">
						<input  type="text" id="name" class="input100 @error('name') is-invalid @enderror"   name="name" value="{{ old('name') }}" required placeholder="Company's Name" autocomplete="name" autofocus>
						<span class="focus-input100" data-placeholder="&#xf209;"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">
						<input  type="text" id="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Company's Email" required autocomplete="email">
						<span class="focus-input100" data-placeholder="&#xf111;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100 @error('password') is-invalid @enderror" name="password" class="" type="password" name="pass" placeholder="Password" name="password" required autocomplete="new-password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100 @error('password') is-invalid @enderror" name="password_confirmation" class="" type="password" name="pass" placeholder="Confirm Password" name="password" required autocomplete="new-password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-20">
						<a class="txt1" href="#">
							Already have an account ?
						</a>
					</div>

					<div class="container-login100-form-btn mt-3">
						<a href="/login" class="login100-form-btn">
							Login
                        </a>
					</div>

					<div class="text-center p-t-20">
						<a class="txt1" href="/password-reset">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../assets/js/main.js"></script>

</body>
</html>




