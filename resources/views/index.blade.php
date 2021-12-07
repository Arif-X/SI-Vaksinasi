<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>SI Vaksinasi</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="/home/img/favicon.png" rel="icon">
	<link href="/home/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/home/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="/home/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="/home/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="/home/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="/home/vendor/owl.carousel/lib/home/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="/home/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="/home/css/style.css" rel="stylesheet">

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
					<li class="menu-active"><a href="">Home</a></li>
					<li><a href="#services">Fitur</a></li>
				</ul>
			</nav><!-- #nav-menu-container -->
		</div>
	</header><!-- End Header -->

	<!-- ======= Intro Section ======= -->
	<section id="intro" class="shadow">

		<div class="intro-content" style="background-image: url('/home/img/bg.jpeg')">
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
						<img src="/home/img/about-img.png" alt="">
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
		<section id="lokasi" class="wow fadeInUp">
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
			<div class="credits">
				Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- Vendor JS Files -->
	<script src="/home/vendor/jquery/jquery.min.js"></script>
	<script src="/home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/home/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="/home/vendor/php-email-form/validate.js"></script>
	<script src="/home/vendor/wow/wow.min.js"></script>
	<script src="/home/vendor/venobox/venobox.min.js"></script>
	<script src="/home/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="/home/vendor/jquery-sticky/jquery.sticky.js"></script>
	<script src="/home/vendor/superfish/superfish.min.js"></script>
	<script src="/home/vendor/hoverIntent/hoverIntent.js"></script>
	<script src="/home/vendor/isotope-layout/isotope.pkgd.min.js"></script>

	<!-- Template Main JS File -->
	<script src="/home/js/main.js"></script>

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