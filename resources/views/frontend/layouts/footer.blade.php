<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- About -->
            <div class="col-lg-3 footer_col">
                <div class="footer_about">
                    <div class="logo_container">
                        <a href="#">
                            <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                                <div class="logo_img"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></div>
                                <div class="logo_text">Tes'B Academy</div>
                            </div>
                        </a>
                    </div>
                    <div class="footer_about_text">
                        <p>A citadel of excellence.</p>
                    </div>
                    <div class="footer_social">
                        <h5><b>Follow Us:</b></h5>
                        <ul>
                            <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="copyright">
                Copyright &copy;    
                <script>document.write(new Date().getFullYear());</script>
                <br> All rights reserved | Tes'B Academy <i class="fa fa-heart-o" aria-hidden="true"></i> by 
                <a href="https://web.facebook.com/profile.php?id=61575036835147" target="_blank"> Ozatech Services</a></div>
                    </div>
            </div>

            <div class="col-lg-3 footer_col">
                <div class="footer_links">
                    <div class="footer_title">Quick menu</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('home') }}">Testimonials</a></li>
                        <li><a href="{{ route('home') }}">Services</a></li>
                        <li><a href="{{ route('home') }}">Facts</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 footer_col">
                <div class="footer_links">
                    <div class="footer_title">Useful Links</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{route('register')}}">Register</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 footer_col">
                <div class="footer_contact">
                    <div class="footer_title">Contact Us</div>
                    <div class="footer_contact_info">
                        <div class="footer_contact_item">
                            <div class="footer_contact_title"><i class="fa fa-map-marker style-icon"></i> Address:</div>
                            <div class="footer_contact_line">opposite Grain Reserve, Terwase Agbadu, Makurdi, Benue State.</div>
                        </div>
                        <div class="footer_contact_item">
                            <div class="footer_contact_title"><i class="fa fa-phone style-icon"></i> Phone:</div>
                            <div class="footer_contact_line">+234 8069263946</div>
                        </div>
                        <div class="footer_contact_item">
                            <div class="footer_contact_title"><i class="fa fa-envelope style-icon"></i> Email:</div>
                            <div class="footer_contact_line">info@tesbacademy.com.ng</div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</footer>