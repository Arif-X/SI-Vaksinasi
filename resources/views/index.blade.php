<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>SI Vaksinasi</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="/homes/img/favicon.png" rel="icon">
	<link href="/homes/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="/homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/homes/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="/homes/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="/homes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="/homes/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="/homes/vendor/owl.carousel/lib/home/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="/homes/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="/homes/css/style.css" rel="stylesheet">

	<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
	<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />

</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header">
		<div class="container">

			<div id="logo" class="pull-left">
				<h1><a href="index.html">SI Vaksinasi</a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="/home/img/logo.png" alt=""></a>-->
			</div>

			<nav id="nav-menu-container">
				<ul class="nav-menu">
					@if (Route::has('login'))
					@auth
					<li class="menu-active"><a href="/user/home">Home</a></li>
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
						</a>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					@else
					<a href="/login" class="btn btn-primary" style="padding: 15px"><strong>Login</strong></a>
					@if (Route::has('register'))                    
					@endif
					@endauth
					@endif
				</ul>
			</nav><!-- #nav-menu-container -->
		</div>
	</header><!-- End Header -->

	<!-- ======= Intro Section ======= -->
	<section id="intro" class="shadow">

		<div class="intro-content" style="background-image: url('/homes/img/bg.jpeg')">
			<h2>SI Vaksinasi</h2>
			<div>

			</div>
		</div>

	</section><!-- End Intro Section -->

	<main id="main">

		<!-- ======= About Section ======= -->
		<section id="about" class="wow fadeInUp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 about-img">
						<img src="/homes/img/about-img.png" alt="">
					</div>

					<div class="col-lg-8 content">
						<h2>Fitur-Fitur pada Website SI Vaksinasi</h2>

						<ul>
							<li><i class="ion-android-checkmark-circle"></i> Daftar Cari Lokasi Vaksinasi.</li>
							<li><i class="ion-android-checkmark-circle"></i> Sertifikat Vaksinasi.</li>
						</ul>

					</div>
				</div>

			</div>
		</section><!-- End About Section -->

		<!-- ======= Location Section ======= -->
		<section id="lokasi" class="wow fadeInUp shadow-lg">
			<div class="container">
				<style type="text/css">
					#map {
						position: relative;
						width: 100%;
						height: 500px;
					}
				</style>

				<div class="mt-5 mb-3">
					<h5 class="text-center">Data Lokasi Vaksinasi Berdasarkan Peta</h5>
					<div id="map"></div>
				</div>				
			</div>
		</section><!-- End Location Section -->
	</main>

	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong>Reveal</strong>. All Rights Reserved
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- Vendor JS Files -->
	<script src="/homes/vendor/jquery/jquery.min.js"></script>
	<script src="/homes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/homes/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="/homes/vendor/php-email-form/validate.js"></script>
	<script src="/homes/vendor/wow/wow.min.js"></script>
	<script src="/homes/vendor/venobox/venobox.min.js"></script>
	<script src="/homes/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="/homes/vendor/jquery-sticky/jquery.sticky.js"></script>
	<script src="/homes/vendor/superfish/superfish.min.js"></script>
	<script src="/homes/vendor/hoverIntent/hoverIntent.js"></script>
	<script src="/homes/vendor/isotope-layout/isotope.pkgd.min.js"></script>

	<!-- Template Main JS File -->
	<script src="/homes/js/main.js"></script>

	<script>
		L.mapbox.accessToken = 'pk.eyJ1IjoiYXJpcG9uIiwiYSI6ImNrbjV3cmZ5NTA4aDUyd25zenk3MmlwYzgifQ.YbJ_Ir794eD8VlrVvpX64g';
		var map = L.mapbox.map('map')
		.setView([-7.9666204, 112.6326321], 10)
		.addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

		@foreach ($koordinats as $koordinat)
		var marker = L.marker(['{{ $koordinat->latitude }}', '{{ $koordinat->longitude }}'], {
			icon: L.mapbox.marker.icon({
				'marker-color': '#9c89cc'
			})
		})

		.bindPopup('<strong>{{ $koordinat->nama_tempat }}<br>Alamat: {{ $koordinat->alamat }}</strong>')
		.addTo(map);	
		@endforeach

	</script>

</body>

</html>