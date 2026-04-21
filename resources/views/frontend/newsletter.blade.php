<!DOCTYPE html>
<html lang="en">
<head>
<title>Newsletter | Tes'B Academy</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Read and download the latest Tes'B Academy newsletter.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/plugins/video-js/video-js.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/about_responsive.css') }}">
<style>
    /* ── Newsletter page overrides ───────────────────────────── */

    .newsletter-section { padding: 50px 0 70px; background: #f7f9fb; }

    .pdf-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,.08);
        overflow: hidden;
    }
    .pdf-card .pdf-header {
        background: linear-gradient(90deg,#1a3a5c,#0d6efd);
        color:#fff;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .pdf-card .pdf-header h2 {
        font-size: 1.2rem;
        margin: 0;
        font-weight: 600;
    }
    .pdf-card iframe {
        width: 100%;
        height: 800px;
        border: none;
        display: block;
    }
    .pdf-card .pdf-footer {
        padding: 16px 24px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .empty-state {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,.08);
        padding: 70px 40px;
        text-align: center;
    }
    .empty-state i { font-size: 5rem; color: #b0c4de; display: block; margin-bottom: 20px; }
    .empty-state h3 { color: #1a3a5c; font-weight: 700; }
    .empty-state p { color: #6c757d; max-width: 400px; margin: .5rem auto 1.5rem; }

    @media (max-width: 576px) {
        .pdf-card iframe { height: 500px; }
        .newsletter-hero h1 { font-size: 1.8rem; }
    }
</style>
</head>
<body>

<div class="super_container">

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Mobile Menu -->
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
                <li class="menu_mm {{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="menu_mm {{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
                <li class="menu_mm {{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                <li class="menu_mm {{ request()->routeIs('newsletter') ? 'active' : '' }}"><a href="{{ route('newsletter') }}">Newsletter</a></li>
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
		<!-- Background image -->
		<div class="home_background parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/about.jpg') }}" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
							<div class="home_title">Newsletter</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{ route('home') }}">Home</a></li>
									<li>Newsletter</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    @if ($newsletterExists)
                        <div class="pdf-card">
                            <div class="pdf-header">
                                <h2><i class="fa fa-file-pdf-o me-2"></i>Latest Newsletter</h2>
                                <a href="{{ asset('uploads/newsletter/newsletter.pdf') }}"
                                   download
                                   class="btn btn-sm btn-light text-primary fw-semibold">
                                    <i class="fa fa-download me-1"></i> Download PDF
                                </a>
                            </div>

                            {{-- Embedded PDF viewer --}}
                            <iframe
                                src="{{ asset('uploads/newsletter/newsletter.pdf') }}#toolbar=1&view=FitH"
                                title="Tes'B Academy Newsletter"
                                loading="lazy">
                                {{-- Fallback for browsers that can't render PDFs --}}
                                <p class="p-4 text-muted">
                                    Your browser does not support embedded PDFs.
                                    <a href="{{ asset('uploads/newsletter/newsletter.pdf') }}" class="text-primary">
                                        Click here to download the newsletter.
                                    </a>
                                </p>
                            </iframe>

                            <div class="pdf-footer">
                                <i class="fa fa-info-circle text-primary"></i>
                                <span class="text-muted small">
                                    If the newsletter doesn't display correctly in your browser, use the download button above.
                                </span>
                                <a href="{{ asset('uploads/newsletter/newsletter.pdf') }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary ms-auto">
                                    <i class="fa fa-external-link me-1"></i> Open in New Tab
                                </a>
                            </div>
                        </div>

                    @else
                        <div class="empty-state">
                            <i class="fa fa-newspaper-o"></i>
                            <h3>No Newsletter Available Yet</h3>
                            <p>The school newsletter hasn't been published yet. Please check back soon for updates from Tes'B Academy.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary px-4">
                                <i class="fa fa-home me-1"></i> Back to Home
                            </a>
                        </div>
                    @endif

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
