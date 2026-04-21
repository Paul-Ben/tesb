@extends('dashboards.admin')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded p-4">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="mb-0"><i class="fa fa-newspaper-o me-2 text-primary"></i>Newsletter Management</h5>
                    @if ($newsletterExists)
                        <a href="{{ asset('uploads/newsletter/newsletter.pdf') }}" target="_blank"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye me-1"></i> Preview Current Newsletter
                        </a>
                    @endif
                </div>

                {{-- Success / error flash --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($newsletterExists)
                    <div class="alert alert-info d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa fa-info-circle"></i>
                        <span>A newsletter is currently published. Uploading a new PDF will <strong>replace</strong> the existing one immediately.</span>
                    </div>
                @else
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span>No newsletter has been published yet. Upload a PDF to make it available on the public site.</span>
                    </div>
                @endif

                {{-- Upload Form --}}
                <form action="{{ route('newsletter.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="newsletter_file" class="form-label fw-semibold">
                            Select Newsletter PDF <span class="text-danger">*</span>
                        </label>
                        <input
                            type="file"
                            class="form-control @error('newsletter') is-invalid @enderror"
                            id="newsletter_file"
                            name="newsletter"
                            accept=".pdf"
                            required>
                        @error('newsletter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Accepted format: PDF only. Maximum file size: 20 MB.</div>
                    </div>

                    {{-- Live file-name preview --}}
                    <div id="file-preview" class="mb-3 d-none">
                        <div class="d-flex align-items-center gap-2 p-3 border rounded bg-white">
                            <i class="fa fa-file-pdf-o fa-2x text-danger"></i>
                            <div>
                                <div id="file-name" class="fw-semibold text-dark"></div>
                                <div id="file-size" class="small text-muted"></div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-upload me-2"></i>
                        {{ $newsletterExists ? 'Replace Newsletter' : 'Upload Newsletter' }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('newsletter_file').addEventListener('change', function () {
        const file = this.files[0];
        const preview = document.getElementById('file-preview');
        const nameEl  = document.getElementById('file-name');
        const sizeEl  = document.getElementById('file-size');

        if (file) {
            nameEl.textContent = file.name;
            sizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endsection
