<header class="header">	
    <!-- Top Bar -->
    <div class="top_bar">
        <div class="top_bar_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            <ul class="top_bar_contact_list">
                                <li><div class="question">Have any questions?</div></li>
                                <li>
                                    <div>+234 8069263946</div>
                                </li>
                                <li>
                                    <div>info@tesbacademy.com.ng</div>
                                </li>
                            </ul>
                            <div class="top_bar_login ml-auto">
                                <ul>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>				
    </div>

    <!-- Header Content -->
    <div class="header_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                                    <div class="logo_img"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></div>
                                    <div class="logo_text">Tes'B Academy</div>
                                </div>
                            </a>
                        </div>
                        <nav class="main_nav_contaner ml-auto">
                            <ul class="main_nav">
                                <li class="active"><a href="{{ route('home') }}">home</a></li>
                                <li><a href="{{ route('about') }}">about us</a></li>
                                <li><a href="{{ route('contact') }}">contact</a></li>
                            </ul>
                            <div class="search_button"><i class="fa fa-search" aria-hidden="true"></i></div>

                            <!-- Hamburger -->

                            <div class="hamburger menu_mm">
                                <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Search Panel -->
    <div class="header_search_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_search_content d-flex flex-row align-items-center justify-content-end">
                        <form action="#" class="header_search_form">
                            <input type="search" class="search_input" placeholder="Search" required="required">
                            <button class="header_search_button d-flex flex-column align-items-center justify-content-center">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>			
    </div>			
</header>