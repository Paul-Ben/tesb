@extends('dashboards.admin')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-4">
                <a href="{{url()->previous()}}" class="btn btn-primary me-2 mb-2">
                    Back
                </a>
            </div>
            <div class="card shadow-sm">
                <div class="row g-0">
                    
                    <!-- Profile Section -->
                    <div class="col-md-4">
                        <img class="img-fluid  border border-primary" 
                             src="{{asset('images'.'/'.$student->image)}}" 
                             alt="Student Image" style="height: 80%; width: 70%;">
                    </div>

                    <!-- Student Information -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title text-center text-md-start">Student Name: {{$student->last_name." ".$student->middle_name." ".$student->first_name}}</h1>
                            <p class="card-text text-muted mb-1">Date of Birth: {{$student->date_of_birth}}</p>
                            <p class="card-text text-muted mb-1">Class: {{$student->classroom->name}}</p>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Details Section -->
                <div class="row g-0">
                    
                    <!-- Student Data -->
                    <div class="col-md-6">
                        <h2 class="h4 mb-4">Student Data</h2>
                        <div class="mb-4">
                            <label class="form-label">First Name : <strong>{{$student->first_name}}</strong></label>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Middle Name :<strong> {{$student->middle_name}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Last Name :<strong> {{$student->last_name}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Date of Birth : {{$student->date_of_birth}}</label>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <!-- Guardian Data -->
                    <div class="col-md-6">
                        <h2 class="h4 mb-4">Guardian Data</h2>
                        <div class="mb-4">
                            <label class="form-label">Guardian Name : <strong>{{$student->guardian->guardian_name}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Guardian Phone : <strong>{{$student->guardian->guardian_phone}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Guardian Email : <strong>{{$student->guardian->guardian_email}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Guardian Address : <strong>{{$student->guardian->address}}</strong></label>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection