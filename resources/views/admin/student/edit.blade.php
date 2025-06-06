@extends('dashboards.admin')
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
                    <h4>Edit Student</h4>
                    <form action="{{ route('student.update', $student) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" value="{{$student->first_name}}" id="first_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" value="{{$student->middle_name}}" id="middle_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Gender</label>
                                    <select name="gender" id="" class="form-control">
                                        <option value="{{$student->gender}}">{{$student->gender}}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stateoforigin">State of Origin</label>
                                    <select name="stateoforigin" id="state" class="form-control"
                                        onchange="selectLGA(this)">
                                        <option value="{{$student->stateoforigin}}" selected="selected">{{$student->stateoforigin}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="genotype">Genotype</label>
                                    <input type="text" name="genotype" value="{{$student->genotype}}" id="genotype" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardian_name">Guardian Name</label>
                                    <input type="text" name="guardian_name" value="{{$studentguardian->guardian_name}}" id="guardian_name" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{$studentguardian->guardian_email}}" id="email" class="form-control" disabled>
                                </div>
                               
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" value="{{$student->image}}" id="image" class="form-control">
                                    <p id="error-message" style="color: red; display: none;">Please select a valid image file.</p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" value="{{$student->last_name}}" id="last_name" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="std_number">Student Number</label>
                                    <input type="text" name="std_number" value="{{$student->std_number}}" id="std_number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" name="nationality" value="{{$student->nationality}}" id="nationality" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="lga">LGA</label>
                                    <select name="lga" id="lga" class="form-control">
                                        <option value="{{$student->lga}}" selected>{{$student->lga}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" value="{{$student->date_of_birth}}" id="date_of_birth" class="form-control"
                                        required>
                                </div>
                               
                                <div class="form-group">
                                    <label for="bgroup">Blood Group</label>
                                    <input type="text" name="bgroup" value="{{$student->bgroup}}" id="bgroup" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="guardian_phone">Guardian Phone</label>
                                    <input type="text" name="guardian_phone" value="{{$studentguardian->guardian_phone }}" id="guardian_phone"
                                        class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="guardian_email">Guardian Email</label>
                                    <input type="email" name="guardian_email" value="{{$studentguardian->guardian_email}}" id="guardian_email"
                                        class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" value="{{$studentguardian->address}}" id="address" class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- Full-Width Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" id="class_id" class="form-control" required>
                                        <option value="{{$student->class_id}}">{{$student->classroom->name}}</option>
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
                                        <option value="{{$student->current_session}}">{{$currentSession->sessionName}}</option>
                                        @foreach ($schoolSessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->sessionName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
    <script src="{{ asset('assets/scripts/statesnlga.js') }}"></script>
    <script>
         document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0]; // Get the selected file
        const errorMessage = document.getElementById('error-message');
    
        if (file) {
            // Check if the file is an image
            if (!file.type.startsWith('image/')) {
                // Display error message
                errorMessage.style.display = 'block';
                // Clear the file input
                event.target.value = '';
            } else {
                // Hide error message if the file is valid
                errorMessage.style.display = 'none';
            }
        }
    });
    </script>
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
