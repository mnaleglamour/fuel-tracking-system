@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold" style="color:var(--primary-navy)">CAP File Management</h4>
            <p class="text-muted mb-0 small">Upload and manage official CAP documents (PDF)</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 py-3 px-4" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-file-earmark-arrow-up me-2" style="color:var(--accent-blue)"></i>Upload CAP Document
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cap.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="cap_file" class="form-label fw-semibold">
                                Select PDF File <span class="text-danger">*</span>
                            </label>
                            <input type="file" id="cap_file" name="cap_file"
                                accept="application/pdf"
                                class="form-control" required>
                            <div class="form-text">Maximum file size: 10MB. PDF only.</div>
                        </div>
                        <button type="submit" class="btn text-white fw-semibold w-100" style="background:var(--accent-blue)">
                            <i class="bi bi-cloud-upload me-1"></i> Upload File
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 py-3 px-4 d-flex align-items-center justify-content-between" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-files me-2" style="color:var(--warning-amber)"></i>Uploaded Files
                    </h6>
                    <span class="badge rounded-pill" style="background:var(--accent-blue)">{{ $caps->total() }}</span>
                </div>
                <div class="card-body p-0">
                    @forelse($caps as $cap)
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded"
                                    style="width:42px;height:42px;background:#fff0f0;flex-shrink:0">
                                    <i class="bi bi-file-earmark-pdf-fill fs-5" style="color:#dc2626"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small" style="color:var(--primary-navy)">{{ $cap->original_name }}</div>
                                    <div class="text-muted" style="font-size:12px">
                                        Uploaded by <strong>{{ $cap->user->name }}</strong> &middot;
                                        {{ $cap->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.cap.download', $cap->id) }}"
                                    class="btn btn-sm btn-outline-success d-flex align-items-center gap-1">
                                    <i class="bi bi-download"></i>
                                    <span class="d-none d-sm-inline">Download</span>
                                </a>
                                <form action="{{ route('admin.cap.destroy', $cap->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this file?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                        <i class="bi bi-trash"></i>
                                        <span class="d-none d-sm-inline">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex flex-column align-items-center justify-content-center py-5 text-center">
                            <i class="bi bi-folder2-open mb-3" style="font-size:3rem;color:var(--border-color)"></i>
                            <h6 class="fw-semibold text-muted">No files uploaded yet</h6>
                            <p class="text-muted small">Start by uploading a CAP document.</p>
                        </div>
                    @endforelse
                </div>
                @if($caps->hasPages())
                    <div class="card-footer border-0 py-3 px-4 d-flex justify-content-center" style="background:var(--bg-light)">
                        {{ $caps->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
