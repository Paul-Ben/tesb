@extends('layouts.homepage')
@include('layouts.logandregister')
@section('content')
{{-- <section class="sign-up parallax parallax_one animatedParent" data-sequence="500" data-stellar-background-ratio="0.5">
    <div class="parallax_inner">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-6 text-center">
                    <div class="info">
                        <h2 class="color-white">Benue State Government</h2>
                        <h1 class="color-white">E-Filing System</h1>
                        <h2 class="mb-30 color-white">Digitize It</h2>
                        <span class="subscribe">Secure and reliable<br> document management<i
                                class="fa fa-arrow-circle-o-right"></i></span>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6">
                    <div class="signup-form animated bounceInUp" data-id="1">
                        <form action="{{ route('register') }}" method="POST" >
                            @csrf
                           
                            <h4 class="color-white">REGISTER</h4>
                            <label>Name</label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" required autofocus autocomplete="name">
                            <span>{{ $errors->first('name') }}</span>
                            <label>Email</label>
                            <input type="email" id="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username">
                            <span>{{ $errors->first('email') }}</span>
                            <label>Password</label>
                            <input name="password" type="password" id="password" required autocomplete="current-password">
                            <span>{{ $errors->first('password') }}</span>
                            <label>Confirm Password</label>
                            <input name="password_confirmation" type="password" id="password_confirmation" required autocomplete="cnew-password">
                            <span>{{ $errors->first('password_confirmation') }}</span>
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center"> 
                                    <span class="ms-2 small text-black">Already Registered? </span>
                                  <a href="{{route('login')}}">
                                <span class="ms-2 small text-white">Login </span>
                                </a>  
                                    
                                        </label>
                                        </div>
                            <button type="submit" class="btn btn-wide btn-yellow mt-20">REGISTER</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<div>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form class="mb-3" action="{{ route('register') }}" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingText" placeholder="Full Name" required autofocus autocomplete="name">
                            <label for="floatingText">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required autocomplete="username">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required autocomplete="current-password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" class="form-control" id="floatingPassword" placeholder="Password" required autocomplete="cnew-password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
</div>
@endsection

