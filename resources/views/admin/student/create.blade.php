@extends('dashboards.admin')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="nationality">Gender</label>
                                    <select name="gender" id="" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stateoforigin">State of Origin</label>
                                    <select name="stateoforigin" id="state" class="form-control"
                                        onchange="selectLGA(this)">
                                        <option value="" selected="selected">Select State</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="genotype">Genotype</label>
                                    <select name="genotype" id="genotype" class="form-control">
                                        <option value="" selected>Select Genotype</option>
                                        <option value="AA">AA</option>
                                        <option value="AS">AS</option>
                                        <option value="SS">SS</option>
                                        <option value="SC">SC</option>
                                        <option value="AC">AC</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <p id="error-message" style="color: red; display: none;">Please select a valid image
                                        file.</p>
                                </div>
                                <div class="form-group">
                                    <label for="address">Paarent/Guardian</label>
                                    <select name="guardian_id" id="guardian_id" class="form-control" required>
                                        <option value="" selected>Select Guardian</option>
                                        @foreach ($guardians as $guardian)
                                            <option value="{{ $guardian->id }}">{{ $guardian->guardian_name }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="text"
                                        value="{{ 'TesB' . '/' . substr(rand(1, 1000000) . microtime(true), 0, 6) }}"
                                        name="std_number" id="std_number" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="lga">LGA</label>
                                    <select name="lga" id="lga" class="form-control">
                                        <option value="" selected>Select LGA</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="bgroup">Blood Group</label>
                                    <select name="bgroup" id="bgroup" class="form-control">
                                        <option value="" selected>Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
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
    <!-- Form End -->
    <script>
        //Fetch all States
        fetch('https://nga-states-lga.onrender.com/fetch')
            .then((res) => res.json())
            .then((data) => {
                var x = document.getElementById("state");
                for (let index = 0; index < Object.keys(data).length; index++) {
                    var option = document.createElement("option");
                    option.text = data[index];
                    option.value = data[index];
                    x.add(option);
                }
            });
        //Fetch Local Goverments based on selected state
        function selectLGA(target) {
            var state = target.value;
            fetch('https://nga-states-lga.onrender.com/?state=' + state)
                .then((res) => res.json())
                .then((data) => {
                    var x = document.getElementById("lga");

                    var select = document.getElementById("lga");
                    var length = select.options.length;
                    for (i = length - 1; i >= 0; i--) {
                        select.options[i] = null;
                    }
                    for (let index = 0; index < Object.keys(data).length; index++) {
                        var option = document.createElement("option");
                        option.text = data[index];
                        option.value = data[index];
                        x.add(option);
                    }
                });
        }
    </script>
@endsection
