@extends('dashboards.user')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2 d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ url()->previous() }}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ route('student.create') }}" style="color: #fff;">
                            <i class="fa fa-plus
                        me-2"></i>Add
                        </a>
                    </button>
                </div>
                <h3>{{ $errors }}</h3>
            </div>
        </div>
    </div>
    <!-- Button End -->
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row w-100 mx-1">
            <div class="col-lg-12 mx-auto">
                <div class="bg-light rounded h-100 p-4">
                    <h4>Create New Student</h4>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="lga">LGA</label>
                                    <input type="text" name="lga" id="lga" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="genotype">Genotype</label>
                                    <input type="text" name="genotype" id="genotype" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardian_name">Guardian Name</label>
                                    <input type="text" name="guardian_name" id="guardian_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <p id="error-message" style="color: red; display: none;">Please select a valid image
                                        file.</p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="std_number">Student Number</label>
                                    <input type="text" name="std_number" id="std_number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stateoforigin">State of Origin</label>
                                    <input type="text" name="stateoforigin" id="stateoforigin" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="bgroup">Blood Group</label>
                                    <input type="text" name="bgroup" id="bgroup" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="guardian_phone">Guardian Phone</label>
                                    <input type="text" name="guardian_phone" id="guardian_phone"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="guardian_email">Guardian Email</label>
                                    <input type="email" name="guardian_email" id="guardian_email"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Full-Width Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" id="class_id" class="form-control" required>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current_session">Current Session</label>
                                    <select name="current_session" id="current_session" class="form-control" required>
                                        @foreach ($schoolSessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->sessionName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3"><button type="submit" class="btn btn-primary">Submit</button></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
