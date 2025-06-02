@extends('dashboards.teacher')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Profile Information</h6>
                    <p>Update your account's profile information and email address.</p>
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-sm-12 col-xl-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="image-container" onclick="document.getElementById('fileInput').click();">
                                        {{-- <img id="profileImage" src="{{ $authUser->teacher->image ? asset('storage/' . $authUser->teacher->image) : asset('uploads/avatars/default-avatar.jpg') }}" alt="Profile Photo"> --}}
                                        <img id="profileImage"
                                            src="{{ optional($authUser->teacher)->image ? asset('storage/' . $authUser->teacher->image) : asset('uploads/avatars/default-avatar.jpg') }}"
                                            alt="Profile Photo">
                                        <div class="overlay">Click to upload</div>
                                    </div>
                                    <input type="file" name="avatar" id="fileInput" class="file-input" accept="image/*"
                                        onchange="previewImage(event)">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ $authUser->teacher->first_name ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" value="{{ $authUser->teacher->middle_name ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ $authUser->teacher->last_name ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" name="email" value="{{ $authUser->teacher->email ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date of Birth</label>
                                <input type="text" name="date_of_birth" value="{{ $authUser->teacher->date_of_birth ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ $authUser->teacher->phone_number ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Qualification</label>
                                <input type="text" name="qualification" value="{{ $authUser->teacher->qualification ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $authUser->teacher->address ?? '' }}"
                                    class="form-control">
                            </div>

                            <div style="text-align: left;">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                {{-- @if (session('status') === 'profile-updated')
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    id="statusMessage">
                                    {{ __('Saved.') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById('statusMessage').classList.remove('show');
                                    }, 2000);
                                </script>
                            @endif --}}
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
