<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Results | Tes'B Academy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="View student results">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/responsive.css') }}">
    <style>
        .result-search-section {
            padding: 60px 0;
            background: #f8f9fa;
            min-height: 60vh;
        }
        .search-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        .search-card h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .btn-primary {
            background: #ff6b6b;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background: #ee5a5a;
        }
        .alert {
            border-radius: 5px;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-box p {
            margin: 0;
            color: #1565C0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="super_container">

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Menu -->
    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
        <nav class="menu_nav">
            <ul class="menu_mm">
                <li class="menu_mm {{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{route('home')}}">Home</a></li>
                <li class="menu_mm {{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{route('about')}}">About Us</a></li>
                <li class="menu_mm {{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{route('contact')}}">Contact</a></li>
                <li class="menu_mm {{ request()->routeIs('newsletter') ? 'active' : '' }}"><a href="{{route('newsletter')}}">Newsletter</a></li>
                <li class="menu_mm {{ request()->routeIs('result.search') ? 'active' : '' }}"><a href="{{route('result.search')}}">Results</a></li>
            </ul>
        </nav>
    </div>

    <!-- Result Search Section -->
    <div class="result-search-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-card">
                        <h2><i class="fa fa-graduation-cap"></i> View Student Results</h2>

                        <div class="info-box">
                            <p><strong>Note:</strong> Enter your student's admission number, select the session and term to view the result. You must have paid school fees for the selected term to access the result.</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('message'))
                            <div class="alert alert-{{ session('alert-type') == 'error' ? 'danger' : session('alert-type') }}">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form action="{{ route('result.check') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="student_number">Student Admission Number</label>
                                <input type="text" name="student_number" id="student_number" class="form-control" placeholder="e.g. TESB/2024/001" required>
                            </div>

                            <div class="form-group">
                                <label for="session">Session</label>
                                <select name="session" id="session" class="form-control" required>
                                    <option value="" selected>Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{ $session->sessionName }}">{{ $session->sessionName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="term">Term</label>
                                <select name="term" id="term" class="form-control" required>
                                    <option value="" selected>Select Term</option>
                                    @foreach($terms as $term)
                                        <option value="{{ $term->term_name }}">{{ $term->term_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">View Result</button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('frontend.layouts.footer')
</div>

<script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>
</html>