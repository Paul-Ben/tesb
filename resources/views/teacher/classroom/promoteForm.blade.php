@extends('dashboards.teacher')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ url()->previous() }}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                    <form action="{{ route('promote') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Current Class</label>
                                <input type="text" name="current_class" value="{{ $classroom->name }}"
                                    class="form-control" readonly>
                                <input type="text" name="current_class_id" value="{{ $classroom->id }}"
                                    class="form-control" hidden>

                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Select new class
                                    to promote students.</label>
                                <select name="new_class_id" id="name" class="form-control" required>
                                    <option value="">Select New class to promote students</option>
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Promote</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Form End -->
@endsection
