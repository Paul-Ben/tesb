<!DOCTYPE html>
<html lang="en">
<head>
<title>About us</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Elearn project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/plugins/video-js/video-js.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/about_responsive.css') }}">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	@include('frontend.layouts.header')

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="{{route('home')}}">Home</a></li>
				<li class="menu_mm"><a href="{{route('about')}}">About Us</a></li>
				<li class="menu_mm"><a href="{{route('contact')}}">Contact</a></li>
			</ul>
		</nav>
		<div class="menu_extra">
			<div class="menu_phone"><span class="menu_title">phone:</span>+234 8069263946</div>
			<div class="menu_social">
				<span class="menu_title">follow us</span>
				<ul>
					<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home">
		<!-- Background image artist https://unsplash.com/@thepootphotographer -->
		<div class="home_background parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/about.jpg') }}" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
							<div class="home_title">About us</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>About us</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- About -->

	<div class="about">
		<div class="container">
			<!-- Mission Section -->
			<div class="row about_row row-lg-eq-height">
				<div class="col-lg-6">
					<div class="about_content">
						<div class="about_title">Our Mission</div>
						<div class="about_text">
							<p>Our mission is to empower individuals with quality education, innovative learning experiences, and skill development opportunities. We strive to bridge the gap between knowledge and real-world application, ensuring that learners gain hands-on experience that fosters personal and professional growth.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 text-center">
					<div class="about_icon">
						<div class="about_image"><img src="{{ asset('frontend/images/mission.png') }}" alt=""></div>
					</div>
					</div>
				</div>
			</div>
	
			<!-- Vision Section -->
			<div class="row about_row row-lg-eq-height ml-4">
				<div class="col-lg-6 order-lg-1 order-2  text-center">
					<div class="about_icon">
						<div class="about_image"><img src="{{ asset('frontend/images/vission.png') }}" alt=""></div>
					</div>
				</div>
				<div class="col-lg-6 order-lg-2 order-1">
					<div class="about_content">
						<div class="about_title">Our Vision</div>
						<div class="about_text">
							<p>Our vision is to create a world where education is accessible, engaging, and transformative. We aspire to be a global leader in digital learning, enabling students and professionals to thrive in their respective fields through cutting-edge technology and innovative teaching methodologies.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 
 
	

	<!-- Milestones -->

	<!-- Teachers -->

	<div class="teachers">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="teachers_title text-center">Meet the Team</div>
				</div>
			</div>
			<div class="row teachers_row">
				
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_1.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Dr. Oluwaseun Adeyemi</a></div>
							<div class="teacher_subtitle">Director</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_2.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Mrs. Funke Balogun</a></div>
							<div class="teacher_subtitle">Principal</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_3.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Mr. Chinedu Okafor</a></div>
							<div class="teacher_subtitle">Vice Principal</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_4.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Mrs. Aisha Yusuf</a></div>
							<div class="teacher_subtitle">Head Teacher</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_5.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Mr. Tunde Ogunleye</a></div>
							<div class="teacher_subtitle">Secretary</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
				<!-- Teacher -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher">
						<div class="teacher_image"><img src="{{ asset('frontend/images/teacher_6.jpg') }}" alt=""></div>
						<div class="teacher_body text-center">
							<div class="teacher_title"><a href="#">Dr. Bolaji Olatunji</a></div>
							<div class="teacher_subtitle">Provost</div>
							<div class="teacher_social">
								<ul>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	
			</div>
			<div class="row">
				<div class="col text-center">
					<div class="button teachers_button"><a href="#">See All Staff<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Footer -->
    @include('frontend/layouts/footer')
</div>

<script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/about.js') }}"></script>
</body>
</html>