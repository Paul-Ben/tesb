<!DOCTYPE html>
<html lang="en">
<head>
<title>Tes'B Academy | Home</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Elearn project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link href="{{ asset('frontend/plugins/video-js/video-js.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/responsive.css') }}">
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
				{{-- <li class="menu_mm"><a href="news.html">News</a></li> --}}
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
		<div class="home_slider_container">
			 
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
				<div class="owl-item">
					<!-- Background image artist https://unsplash.com/@benwhitephotography -->
					<div class="home_slider_background" style="background-image:url({{ asset('frontend/images/salute.png') }})"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content text-center">
										<div class="home_text">
											<div class="home_title">Welcome To Tes'B Academy</div>
											<div class="home_subtitle">
												Empowering students with quality education, innovation, 
												and hands-on learning. Join us to build a brighter future 
												through knowledge and excellence.
											</div>
										</div>
										
										<div class="home_buttons">
											<div class="button home_button"><a href="{{route('about')}}">learn more<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
											<div class="button home_button"><a href="{{route('register')}}">get started<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item">
					<!-- Background image artist https://unsplash.com/@benwhitephotography -->
					<div class="home_slider_background" style="background-image:url({{ asset('frontend/images/salute2.png') }})"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content text-center">
										<div class="home_text">
											<div class="home_title">Excellence in Education</div>
											<div class="home_subtitle">
												At Tes'B Academy, we are committed to nurturing future leaders through quality education, hands-on learning, and a supportive environment. Join us to achieve academic excellence and personal growth.
											</div>
										</div>
										<div class="home_buttons">
											<div class="button home_button"><a href="{{route('about')}}">learn more<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
											<div class="button home_button"><a href="{{route('register')}}">get started<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item">
					<!-- Background image artist https://unsplash.com/@benwhitephotography -->
					<div class="home_slider_background" style="background-image:url({{ asset('frontend/images/smiling-practical.jpg') }})"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content text-center">
										<div class="home_text">
											<div class="home_title">Hands-On Learning </div>
											<div class="home_subtitle">
												Our practical courses are designed to equip students with real-world skills through hands-on training, industry-relevant projects, and expert guidance. Gain the experience you need to excel in your career.
											</div>
										</div>
										<div class="home_buttons">
											<div class="button home_button"><a href="{{route('about')}}">learn more<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
											<div class="button home_button"><a href="{{route('register')}}">get started<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Featured Course -->

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Home Slider Nav -->
					<div class="home_slider_nav_container d-flex flex-row align-items-start justify-content-between">
						<div class="home_slider_nav home_slider_prev trans_200"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
						<div class="home_slider_nav home_slider_next trans_200"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
					</div>
					<div class="featured_container">
						<div class="row">
							<div class="col-lg-6 featured_col">
								<div class="featured_content">
									<div class="featured_header d-flex flex-row align-items-center justify-content-start">
										<div class="featured_tag"><a href="#">Featured</a></div>
									</div>
									<div class="featured_title"><h3><a href="courses.html">Welcome to the Citadel of excellence</a></h3></div>
									<div class="featured_text">
										"At Tes'B Academy, we believe in the power of education to transform lives. Our mission is to equip every student with the knowledge, skills, and confidence to succeed in a rapidly changing world. Stay curious, work hard, and never stop learning—your future starts here!"  
										<br> – Director, Tony Williamson
									</div>									<div class="featured_footer d-flex align-items-center justify-content-start">
										<!-- <div class="featured_author_image"><img src="images/featured_author.jpg" alt="picture"></div>
										<div class="featured_author_name">By <a href="#">Director</a></div> -->
									</div>
								</div>
							</div>
							<div class="col-lg-6 featured_col">
								<!-- Background image artist https://unsplash.com/@jtylernix -->
								<div class="featured_background" style="background-image:url({{ asset('frontend/images/home_logo.png') }})"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Courses -->

	<div class="courses">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="section_title text-center"><h2>What Our Students Say!</h2></div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					
					<!-- Courses Slider -->
					<div class="courses_slider_container">
						<div class="owl-carousel owl-theme courses_slider">
							
							<!-- Slider Item -->
							<div class="owl-item">
								<div class="course">
									<div class="course_body">
										<div class="course_text">
											"Tes'B Academy has transformed my learning experience. The hands-on approach and dedicated teachers have given me the confidence to excel in my studies."
										</div>
										<div class="course_footer d-flex align-items-center justify-content-start">
											<div class="course_author_image"><img src="{{ asset('frontend/images/featured_author.jpg') }}" alt="picture"></div>
											<div class="course_author_name">By <a href="#">Oche Igumale</a></div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Slider Item -->
							<div class="owl-item">
								<div class="course">
									<div class="course_body">
										<div class="course_text">
											"I love the supportive environment at Tes'B Academy. The practical courses helped me gain real-world skills, and the teachers are always there to guide us."
										</div>
										<div class="course_footer d-flex align-items-center justify-content-start">
											<div class="course_author_image"><img src="{{ asset('frontend/images/featured_author.jpg') }}" alt="picture"></div>
											<div class="course_author_name">By <a href="#">Dooshima Aondofa</a></div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Slider Item -->
							<div class="owl-item">
								<div class="course">
									<div class="course_body">
										<div class="course_text">
											"Tes'B Academy is more than just a school; it's a family. The quality of education is outstanding, and I feel well-prepared for my future career."
										</div>
										<div class="course_footer d-flex align-items-center justify-content-start">
											<div class="course_author_image"><img src="{{ asset('frontend/images/featured_author.jpg') }}" alt="picture"></div>
											<div class="course_author_name">By <a href="#">Ruth Cletus</a></div>
										</div>
									</div>
								</div>
							</div>
	
						</div>
						
						<!-- Courses Slider Nav -->
						<div class="courses_slider_nav courses_slider_prev trans_200"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
						<div class="courses_slider_nav courses_slider_next trans_200"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Milestones -->

	<div class="milestones">
		<!-- Background image artis https://unsplash.com/@thepootphotographer -->
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/milestones.jpg') }}" data-speed="0.8"></div>
		<div class="container">
			<div class="row milestones_container">
							
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="{{ asset('frontend/images/milestone_1.svg') }}" alt=""></div>
						<div class="milestone_counter" data-end-value="40">0</div>
						<div class="milestone_text">Subjects</div>
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="{{ asset('frontend/images/milestone_2.svg') }}" alt=""></div>
						<div class="milestone_counter" data-end-value="180">0</div>
						<div class="milestone_text">Students</div>
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="{{ asset('frontend/images/milestone_3.svg') }}" alt=""></div>
						<div class="milestone_counter" data-end-value="24">0</div>
						<div class="milestone_text">Teachers</div>
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="{{ asset('frontend/images/milestone_4.svg') }}" alt=""></div>
						<div class="milestone_counter" data-end-value="1200">0</div>
						<div class="milestone_text">Graduates</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Sections -->
	<div class="grouped_sections">
		<div class="container">
			<div class="row">
				<!-- Why Choose Us -->
				<div class="col-lg-12 grouped_col mb-4">
					<div class="grouped_title_why text-center">Why Choose Us?</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="card text-center p-4">
								<div class="card-icon">
									<i class="fa fa-graduation-cap fa-3x style-icon"></i>
								</div>
								<div class="card-body">
									<h5 class="card-title"><strong>Academic Excellence</strong></h5>
									<p class="card-text">
										Our students receive quality education that prepares them for WAEC, NECO, and UTME with top-notch teachers and modern learning methods.
									</p>
								</div>
							</div>
						</div>
				
						<div class="col-lg-3 col-md-6">
							<div class="card text-center p-4">
								<div class="card-icon">
									<i class="fa fa-balance-scale fa-3x style-icon"></i>
								</div>
								<div class="card-body mb-1">
									<h5 class="card-title"><strong>Strong Moral & Discipline Values</strong></h5>
									<p class="card-text">
										We instill discipline, leadership, and integrity in students, shaping them into responsible and ethical individuals ready for the future.
									</p>
								</div>
							</div>
						</div>
				
						<div class="col-lg-3 col-md-6">
							<div class="card text-center p-4">
								<div class="card-icon">
									<i class="fa fa-building fa-3x style-icon"></i>
								</div>
								<div class="card-body mb-3">
									<h5 class="card-title"><strong>Modern Facilities</strong></h5>
									<p class="card-text">
										Our school is equipped with science and computer labs, a well-stocked library, extracurricular activities.
									</p>
								</div>
							</div>
						</div>
				
						<div class="col-lg-3 col-md-6">
							<div class="card text-center p-4">
								<div class="card-icon">
									<i class="fa fa-shield fa-3x style-icon"></i>
								</div>
								<div class="card-body">
									<h5 class="card-title "> <strong>Career & University Guidance</strong></h5>
									<p class="card-text">
										We offer mentorship, career counseling, and  programs to ensure students take confident steps toward a successful future.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- Video -->

	<!-- <div class="video">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="video_container_outer">
						<div class="video_container">
							<video id="vid1" class="video-js vjs-default-skin" controls data-setup='{ "poster": "images/video.jpg", "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=2hOp408Ib5w"}], "youtube": { "iv_load_policy": 1 } }'>
							</video>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Join -->

	<div class="join">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="section_title text-center">
						<h2>Give Your Child the Best Start in Life</h2>
					</div>
					<div class="section_subtitle text-center">
						We are committed to providing a well-rounded education that nurtures academic excellence, strong moral values, and leadership skills. 
						With experienced teachers, modern learning facilities, and a supportive environment, we prepare students for WAEC, NECO, UTME, and beyond. 
						Enroll your child today and watch them grow into confident, responsible, and successful individuals.
					</div>
				</div>
			</div>
		</div>
		<div class="button join_button">
			<a href="{{route('register')}}">Register Now
				<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			</a>
		</div>
	</div>
	
	<!-- Footer -->

    @include('frontend.layouts.footer')
</div>

<script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('frontend/plugins/video-js/video.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/video-js/Youtube.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>
</html>