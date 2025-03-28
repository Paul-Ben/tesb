@extends('dashboards.admin')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="class_category.html" style="color: #fff;">
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
                    <form action="{{ route('session.update', $schoolsession) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <!-- Session Name Field -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="sessionName" class="form-label">Session Name</label>
                                <input type="text" name="sessionName" value="{{$schoolsession->sessionName}}" class="form-control" required>
                            </div>
                            <!-- Status Field -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="{{$schoolsession->status}}">{{Str::ucfirst($schoolsession->status)}}</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
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

