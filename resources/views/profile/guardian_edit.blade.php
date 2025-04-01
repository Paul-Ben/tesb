@extends('dashboards.user')
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
                                <img id="profileImage" src="{{ $authUser->guardian->image ? asset('storage/' . $authUser->guardian->image) : asset('uploads/avatars/default-avatar.jpg') }}" alt="Profile Photo">
                                <div class="overlay">Click to upload</div>
                            </div>
                            <input type="file" name="avatar" id="fileInput" class="file-input" accept="image/*" onchange="previewImage(event)">
                        </div>
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Full Name</label>
                            <input type="text" name="guardian_name" value="{{ $authUser->guardian->guardian_name }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                            <input type="text" name="guardian_phone" value="{{ $authUser->guardian->guardian_phone }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" name="guardian_email" value="{{ $authUser->guardian->guardian_email }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nationality</label>
                            <input type="text" name="nationality" value="{{ $authUser->guardian->nationality }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">State Of Origin</label>
                            <input type="text" name="stateoforigin" value="{{ $authUser->guardian->stateoforigin }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">LGA</label>
                            <input type="text" name="lga" value="{{ $authUser->guardian->lga }}" class="form-control">
                        </div>
                        <div class="col-sm-12 col-xl-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <textarea type="text" name="address" class="form-control">{{ $authUser->guardian->address }}</textarea>
                        </div>
                       
                        <div style="text-align: left;">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            @if (session('status') === 'profile-updated')
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
                            @endif 
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection