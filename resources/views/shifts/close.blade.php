@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-stop-circle me-2"></i>Close Shift</h1>
    <p>Enter closing meter reading to complete this shift</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4 border-start border-primary border-4">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-info-circle text-primary"></i>
                <span class="fw-semibold">Current Shift Information</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc;">
                            <small class="text-muted d-block mb-1">Pump</small>
                            <span class="fw-bold" style="color:var(--primary-navy);">{{ $shift->pump->name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc;">
                            <small class="text-muted d-block mb-1">Opening Meter</small>
                            <span class="fw-bold text-primary">{{ number_format($shift->opening_meter, 2) }} L</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-stop-circle text-danger"></i>
                <span class="fw-semibold">Close Shift</span>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-x-circle me-2"></i><strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('shifts.close', $shift) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="closing_meter" class="form-label fw-semibold">Closing Meter Reading <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control form-control-lg"
                               name="closing_meter" id="closing_meter"
                               value="{{ old('closing_meter') }}" required
                               placeholder="Enter closing meter reading">
                        <small class="text-muted">Must be greater than opening meter ({{ number_format($shift->opening_meter, 2) }} L)</small>
                        @error('closing_meter')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(auth()->user() && auth()->user()->isAdmin())
                        <div class="mb-4">
                            <div class="form-check p-3 rounded-3" style="background:#fff3cd;">
                                <input type="checkbox" class="form-check-input" name="force" id="force" value="1">
                                <label class="form-check-label fw-semibold" for="force">
                                    <i class="bi bi-exclamation-triangle text-warning me-1"></i>
                                    Admin Override &mdash; Force close this shift
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-danger flex-fill"
                                onclick="return confirm('Are you sure you want to close this shift?')">
                            <i class="bi bi-stop-circle me-2"></i>Close Shift
                        </button>
                        <a href="{{ route('shifts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
