@extends('dashboards.admin')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{url()->previous()}}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button End -->

    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Fill All Fields Required</h6>
                    <form action="{{route('teacher.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Qualification</label>
                                <input type="text" name="qualification" class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Form End -->
@endsection
