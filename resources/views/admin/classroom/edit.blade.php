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
                    <form action="{{route('classroom.update', $classroom)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Classroom Name -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="name" class="form-label">Classroom Name</label>
                                <input type="text" name="name" value="{{$classroom->name}}" class="form-control" required>
                            </div>
    
                            <!-- Category ID -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="{{$classroom->category_id}}">{{$category->name}}</option>
                                    <!-- Populate this dropdown with categories from the database -->
                                    @foreach($classCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <!-- Teacher Name -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="teacher_name" class="form-label">Teacher Name</label>
                                <select name="teacher_id" class="form-control" required>
                                    <!-- Populate this dropdown with categories from the database -->
                                    <option value="{{$classroom->teacher->id}} ">{{ $classroom->teacher->first_name." ".$classroom->teacher->last_name }}</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name." ".$teacher->last_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="teacher_name" value="{{$classroom->teacher_name}}" class="form-control"> --}}
                            </div>
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
