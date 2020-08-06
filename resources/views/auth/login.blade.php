<!DOCTYPE html>
<html lang="en">
<head>
	<title>SJL Tracking</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/logo.png"/>

	<script src="{{ asset('sources/tether.min.js') }}"></script>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendorlogin/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendorlogin/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<script src="{{ asset('js/app.js') }}" ></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #f8fafc;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
					@csrf
					
					<div  style="text-align: center;">
						<img src="img/logo.png" height="80px" alt="SJL">
						<span class="login100-form-title p-b-43">
							{{ __('Se connecter à SJL Tracking') }}
						</span>
					</div>
					
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="email" type="text" class="input100" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="label-input100">Adresse e-mail</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input id="password" type="password" class="input100" name="password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="label-input100">Mot de passe</span>
					</div>

			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							{{ __('Se connecter') }}
						</button>
					</div>
					

					
				</form>

				<div class="login100-more" style="background-image: url('img/img2.jpg');background-position: 35% 75%;">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
	<!--===============================================================================================-->
	<script src="{{ asset('sources/jquery.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="vendorlogin/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendorlogin/bootstrap/js/popper.js"></script>
	<script src="{{ asset('sources/bootstrap.js') }}"></script>
	<!--===============================================================================================-->
	<script src="vendorlogin/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('sources/moment.js') }}"></script>
	<script src="vendorlogin/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendorlogin/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->		
	<script src="js/main.js"></script>

</body>
</html>