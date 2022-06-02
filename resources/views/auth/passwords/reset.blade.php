{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}





<!DOCTYPE html>
<html lang="en">
<head>
	<title>Password Reset</title>
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

	<link rel="stylesheet" type="text/css" href="/front-end/css/util.css">
	<link rel="stylesheet" type="text/css" href="/front-end/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
        
        
		<div class="container-login100" style="background-image: url('front-end/images/bg-01.jpg');">
           
            <div class="wrap-login100">
                {{-- display success message if any --}}
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

				<form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
					<span class="login100-form-logo">
						<img src="front-end/images/logo.jpg" width="70" height="70">
					</span>


					<div class="row" style="margin-bottom:20px;">
                            <label for="email" class="col-md-12 col-form-label text-white text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                    </div>

                      @error('email')
                        <p style="color:white; text-align:center; margin-left:-20px; margin-bottom:10px; padding-left:5px; width:100%;">
                            <strong>{{ $message }}</strong>
                        </p>
                      @enderror

                      <div class="row mb-3">
                        <label for="password" class="col-md-12 text-white col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    @error('password')
                        <p style="color:white; text-align:center; margin-left:-20px; margin-bottom:10px; padding-left:5px; width:100%;">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-12  text-white col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Reset Password
                        </button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/front-end/vendor/jquery/jquery-3.2.1.min.js"></script>


</body>
</html>

