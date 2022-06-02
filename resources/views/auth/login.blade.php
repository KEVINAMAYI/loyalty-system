<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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

				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf

                    <span class="login100-form-logo">
						<img src="front-end/images/logo.jpg" width="70" height="70">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						SIGN IN 
					</span>

					<div  class="wrap-input100 validate-input" data-validate = "Enter username">
						<input id="email" type="email" class="input100  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                   

					<div  class="wrap-input100 validate-input" data-validate="Enter password">
						<input id="password" type="password" class="input100  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>



                    <div style="margin-top:20px;" class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox"  class="form-check-input"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					{{-- <div class="text-center p-t-20">
						<a class="txt1" href="/register">
							Register as a Cooperate Customer
						</a>
					</div> --}}

                    @if (Route::has('password.request'))
					<div class="text-center p-t-20">
						<a class="txt1" href="/password-reset">
							Forgot Password?
						</a>
					</div>
                    @endif
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





