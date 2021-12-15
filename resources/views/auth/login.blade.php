<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>SI Vaksinasi Covid-19</title>
	<link rel="shortcut icon" href="assets/img/favicon1.png" type="image/png">
	<!--===============================================================================================-->  
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/animate/animate.css">
	<!--===============================================================================================-->  
	<link rel="stylesheet" type="text/css" href="/auth/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/vendor/select2/select2.min.css">
	<!--===============================================================================================-->  
	<link rel="stylesheet" type="text/css" href="/auth/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/auth/css/util.css">
	<link rel="stylesheet" type="text/css" href="/auth/css/main.css">
	<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">				
				<form class="login100-form validate-form" method="POST" action="{{ route('login.submit') }}">
					@csrf
					<!-- <span class="login100-form-title">
						<div class="text-center">
							<a href="/"><img src="/assets/img/ic_logo_grup.png" class="img-fluid mb-3" style="max-width: 30%;">
							</a>
						</div>
					</span> -->

					<span class="login100-form-title p-b-26">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<h6>Email</h6>
						<input class="input100" name="email" type="email" placeholder="Email anda">			
					</div>

					@if ($message = Session::get('success'))
					<h6 class="text-success">{{ $message }}</h6>
					@endif
					@if ($message = Session::get('error'))
					<h6 class="text-danger">{{ $message }}</h6>
					@endif

					<div class="container-login100-form-btn mt-3">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center mt-3">
						<a href="/">< Kembali ke Halaman Utama</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="/auth/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/vendor/bootstrap/js/popper.js"></script>
	<script src="/auth/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/vendor/daterangepicker/moment.min.js"></script>
	<script src="/auth/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="/auth/js/main.js"></script>

</body>
</html>
