<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Code school - Online Learning</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.png" />

    <!-- CSS here  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/elegent-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <!-- css end  here-->
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- pre loader area start -->
    <div class="tp-preloader">
        <div class="tp-preloader__center">
            <span>
                <svg width="170" height="132" viewBox="0 0 170 132" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_6_12)">
                        <path
                            d="M113.978 61.1738L55.4552 2.8186C52.8594 0.230266 48.7298 0.230266 46.252 2.8186L1.88784 46.4673C-0.707934 49.0557 -0.707934 53.1735 1.88784 55.6441L14.5127 68.2329L66.9002 120.353L113.86 75.7626C118.108 71.8801 118.108 65.2916 113.978 61.1738Z"
                            fill="black" />
                        <path
                            d="M167.781 51.5263L90.2621 129.059C86.1325 133.177 79.6431 133.177 75.5134 129.059L31.6212 85.2923C35.7509 89.4101 42.2403 89.4101 46.37 85.2923L123.889 7.75996C126.485 5.17163 130.615 5.17163 133.092 7.75996L167.663 42.2319C170.377 44.8202 170.377 48.938 167.781 51.5263Z"
                            fill="#5392FB" />
                        <path
                            d="M74.9235 35.0551C76.6933 36.8199 78.4632 38.467 79.9971 39.8788C82.1209 41.6436 82.2389 44.8202 80.233 46.8203L48.8478 78.1156C44.1282 82.8217 36.4588 82.8217 31.7392 78.1156C27.0197 73.4095 27.0197 65.7622 31.7392 61.0561L63.1245 29.7608C65.1303 27.7607 68.3161 27.8784 70.0859 29.9961C71.5018 31.5256 73.1536 33.2904 74.9235 35.0551Z"
                            fill="currentColor" class="path-yellow" />
                    </g>
                    <defs>
                        <clipPath id="clip0_6_12">
                            <rect width="169.787" height="131.064" fill="white" transform="translate(0 0.936172)" />
                        </clipPath>
                    </defs>
                </svg>
            </span>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <button class="tp-backtotop">
        <span><i class="fal fa-angle-double-up"></i></span>
    </button>
    <!-- back to top end -->

    <!-- header area start -->
    <header>
        <div class="tp-header__area">
            <div class="tp-header__top theme-bg-2 d-none d-lg-block">
                <div class="container-fluid">
                    <div class="tp-header__container">
                        <div class="row align-items-center">
                            <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-8">
                                <div class="tp-header__info">
                                    <ul>
                                        <li>
                                            <a href="tel:+443003030266"><i class="fa-regular fa-phone"></i> +44300 303
                                                0266</a>
                                        </li>
                                        <li>
                                            <a href="https://goo.gl/maps/qzqY2PAcQwUz1BYN9" target="_blank"><i
                                                    class="fa-regular fa-location-dot"></i> Crown St,
                                                Brookoln, Ny 11225, USA</a>
                                        </li>
                                        <li>
                                            <i class="fa-regular fa-clock"></i> Mon - Sat 8.00 -
                                            18.00
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-4 col-lg-4 col-md-4">
                                <div class="tp-header__top-right d-flex justify-content-end align-items-center">
                                    <div class="tp-header__account">
                                        <ul>
                                            <li>
                                                <a href="{{route('login')}}"><i class="fal fa-user"></i>Login</a>
                                            </li>
                                            <li>|</li>
                                            <li><a href="{{route('register')}}">Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tp-header__main" id="header-sticky">
                <div class="container-fluid">
                    <div class="tp-header__container">
                        <div class="row align-items-center">
                            <div class="col-xxl-5 col-xl-5 col-lg-3 col-md-6 col-6">
                                <div class="tp-header-left d-flex justify-content-between align-items-center">
                                    <div class="logo">
                                        <a href="index.html">
                                            <img src="assets/img/logo/logo.png" alt="logo" />
                                        </a>
                                    </div>
                                    <div class="tp-header-attach d-none d-xl-block">
                                        <div class="tp-header__attach d-flex align-items-center">
                                            <div class="tp-header__category d-none d-xl-block">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                            <a href="course-grid.html"
                                                                class="cat-menu d-flex align-items-center">
                                                                <span>All Categoriess
                                                                    <i class="fa-light fa-chevron-down"></i></span>
                                                            </a>
                                                            <ul class="cat-submenu">
                                                                <li>
                                                                    <a href="course-details.html">Data</a>
                                                                </li>
                                                                <li>
                                                                    <a href="course-details.html">Web Development</a>
                                                                </li>
                                                                <li>
                                                                    <a href="course-details.html">UI/UX</a>
                                                                </li>
                                                                <li>
                                                                    <a href="course-details.html">Social Media</a>
                                                                </li>
                                                                <li>
                                                                    <a href="course-details.html">Productivity</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <div class="tp-header__search">
                                                <form>
                                                    <input type="text" placeholder="Search Courses" />
                                                    <button><i class="fal fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-5 col-xl-5 col-lg-6 d-none d-lg-block">
                                <div class="main-menu text-end">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <li>
                                                <a href="{{route('about-us')}}">About</a>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="course.html">Programmes</a>
                                                <ul class="submenu">
                                                    <li><a href="course-list.html">Programming</a></li>
                                                    <li><a href="course-list.html">Development</a></li>
                                                    <li><a href="course-list.html">Data</a></li>
                                                    <li><a href="course-list.html">Creative Design</a></li>
                                                    <li><a href="course-list.html">Productivity</a></li>
                                                    <li><a href="course.html">Technology</a></li>
                                                    <li><a href="course.html">Marketing</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="careers.html">Careers</a></li>
                                            <li class="has-dropdown">
                                                <a href="#">Resources</a>
                                                <ul class="submenu">
                                                    <li><a href="event.html">Events</a></li>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <!-- <li><a href="instructor.html">Instructor V1</a></li>
                                       <li><a href="instructor-2.html">Instructor V2</a></li>
                                       <li><a href="instructor-details.html">Instructor Details</a></li>
                                       <li><a href="wishlist.html">Wishlist</a></li> -->
                                                    <!-- <li><a href="sign-in.html">Sign In</a></li>
                                       <li><a href="sign-up.html">Sign Up</a></li> -->
                                                    <li><a href="faq.html">Faq</a></li>
                                                    <!-- <li><a href="404.html">404</a></li> -->
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="contact.html">Contact</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-6 col-6">
                                <div class="tp-header__main-right d-flex justify-content-end align-items-center">
                                    <div class="header-acttion-btns d-flex align-items-center d-none d-md-flex">
                                        <a href="sign-in.html" class="tp-btn">
                                            <span>Apply<i class="fa-regular fa-arrow-right"></i>
                                            </span>
                                            <div class="transition"></div>
                                        </a>
                                    </div>
                                    <div class="tp-header__hamburger ml-50 d-lg-none">
                                        <button class="hamburger-btn offcanvas-open-btn">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <!-- offcanvas area start -->
    <div class="offcanvas__area">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__close text-end">
                    <button class="offcanvas__close-btn offcanvas-close-btn">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
                <div class="offcanvas__top mb-40">
                    <div class="offcanvas__subtitle">
                        <span class="text-white d-inline-block mb-25 d-none d-lg-block">ELEVATE YOUR BUSINESS
                            WITH</span>
                    </div>
                    <div class="offcanvas__logo mb-40">
                        <a href="index.html">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo" />
                        </a>
                    </div>
                    <div class="offcanvas-info d-none d-lg-block">
                        <p>
                            Limitless customization options & Elementor compatibility let
                            anyone create a beautiful website with Valiance.
                        </p>
                    </div>
                    <div class="offcanvas__btn d-none d-lg-block">
                        <a href="contact.html" class="tp-btn">Contact us <span></span></a>
                    </div>
                </div>
                <div class="mobile-menu fix mb-40"></div>

                <div class="offcamvas__bottom">
                    <div class="offcanvas__cta mt-30 mb-20">
                        <h3 class="offcanvas__cta-title">Contact info</h3>
                        <span>27 Division St, New York,</span>
                        <span>+154 4808 84082 4830</span>
                        <span>support@noxia.com</span>
                        <span>Office Hours: 8AM - 5PM</span>
                        <span>Sunday - Wekend Day</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-overlay"></div>
    <!-- offcanvas area end -->

    <main>
        @yield('content')
    </main>

    <!-- footer area start -->
    <footer>
        <div class="footer__area grey-bg">
            <div class="container">
                <div class="footer__top">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6">
                            <div class="footer__widget mb-50 footer-col-1">
                                <div class="footer__widget-logo mb-30">
                                    <a href="index.html"><img src="{{ asset('assets/img/logo/logo.png') }}"
                                            alt="" /></a>
                                </div>
                                <div class="footer__widget-content">
                                    <p>
                                        A platform where learning knows no boundaries.
                                    </p>
                                    <div class="footer__social">
                                        <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
                                        <span><a href="#" class="yt"><i
                                                    class="fab fa-youtube"></i></a></span>
                                        <span><a href="#" class="tw"><i
                                                    class="fab fa-twitter"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-6">
                            <div class="footer__widget mb-50 footer-col-2">
                                <h3 class="footer__widget-title">Quick Links</h3>
                                <div class="footer__widget-content">
                                    <ul>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="careers.html">Careers</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="event.html">Events</a></li>
                                        <li><a href="faq.html">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-6">
                            <div class="footer__widget mb-50 footer-col-3">
                                <h3 class="footer__widget-title">Courses</h3>
                                <div class="footer__widget-content">
                                    <ul>
                                        <li><a href="#">Web Development</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Data Science</a></li>
                                        <li><a href="#">Blockchain</a></li>
                                        <li><a href="#">Cloud Computing</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-xl-4 col-lg-3 col-md-6">
                            <div class="footer__widget mb-50 footer-col-4">
                                <h3 class="footer__widget-title">
                                    Sign Up for Our Newsletter
                                </h3>
                                <div class="footer__widget-content">
                                    <div class="footer__subscribe">
                                        <p>
                                            Subscribe now and join our growing community of learners
                                            committed to lifelong education!
                                        </p>
                                        <form action="#">
                                            <div class="footer__subscribe-box">
                                                <div class="footer__subscribe-input">
                                                    <input type="email" placeholder="Email address" />
                                                </div>
                                                <button class="footer-sub-btn" type="submit">
                                                    Subscribe
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer__copyright text-center">
                                <p>© 2024 bdic, All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
