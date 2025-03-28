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
                    <form action="{{ route('term.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Session Name Field -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="termName" class="form-label">Session</label>
                                <select name="session_id" class="form-control" id="session_id">
                                    @foreach ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->sessionName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Term Name Field -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="termName" class="form-label">Term Name</label>
                                <select name="name" class="form-control" id="" required>
                                    <option value="first">First Term</option>
                                    <option value="second">Second Term</option>
                                    <option value="third">Third Term</option>
                                </select>
                            </div>

                            <!-- Status Field -->
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="termName" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="termName" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
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
