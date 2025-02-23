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
                    <form action="{{route('subject.store', $classroom)}}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Classroom Name -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="name" class="form-label">Subject Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
    
                            <!-- Category ID -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="category_id" class="form-label">Code</label>
                               <input type="text" name="code" class="form-control" required>
                            </div>
    
                            <!-- Teacher Name -->
                            {{-- <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="teacher_name" class="form-label">Teacher Name</label>
                                <input type="text" name="teacher_name" class="form-control">
                            </div> --}}
                        </div>
    
                        <!-- Submit and Reset Buttons -->
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
