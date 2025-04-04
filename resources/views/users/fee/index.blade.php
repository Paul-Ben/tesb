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
                <!-- Error Message -->
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ Session::get('error') }}</li>
                        </ul>
                    </div>
                @endif
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Button End -->
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row w-100 mx-1">
            <div class="col-lg-12 mx-auto">
                <div class="bg-light rounded h-100 p-4">
                    <h4>Payment Form</h4>
                    <form action="{{ route('pay.fee') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Full Name</label>
                                    <input type="text" name="student_name" id="first_name" class="form-control"
                                        value="{{ $student->first_name . ' ' . $student->last_name }}" readonly required>
                                    <input type="text" name="student_id" id="first_name" class="form-control"
                                        value="{{ $student->id }}" readonly hidden>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Class</label>
                                    <input type="text" name="student_class" id="nationality" class="form-control"
                                        readonly value="{{ $student->classroom->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="lga">Term</label>
                                    <input type="text" name="term" id="term" class="form-control" readonly
                                        value="{{ $activeTerm->name }}">
                                    <input type="text" name="term_id" id="term_id" class="form-control" readonly
                                        value="{{ $activeTerm->id }}" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="lga">Pay Item</label>
                                    {{-- <input type="text" name="term" id="term" class="form-control" readonly value="{{$activeTerm->name}}"> --}}
                                    <select name="amount" id="amount" class="form-control" required>
                                        <option value="">Select Pay Item</option>
                                        @foreach ($fees as $payItem)
                                            <option value="{{ $payItem->amount }}">{{ $payItem->name.' | '.'NGN '.$payItem->amount }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="guardian_email" value="{{ $authUser->email }}"
                                        id="email" class="form-control" readonly required>

                                </div>
                                <div class="form-group">
                                    <label for="stateoforigin">Student Number</label>
                                    <input type="text" name="student_number" value="{{ $student->std_number }}"
                                        id="stateoforigin" class="form-control" readonly required>

                                </div>
                                <div class="form-group">
                                    <label for="guardian_phone">Phone Number</label>
                                    <input type="text" name="guardian_phone" id="guardian_phone"
                                        value="{{ $guardian->guardian_phone }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Session</label>
                                    <input type="text" value="{{ $activeTerm->schoolSession->sessionName }}"
                                        name="session" id="address" class="form-control" readonly>
                                    <input type="text" value="{{ $activeTerm->schoolSession->id }}" name="session_id"
                                        id="address" class="form-control" readonly hidden>
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
