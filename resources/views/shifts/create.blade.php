@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-play-circle me-2"></i>Open New Shift</h1>
    <p>Start a new shift by selecting your pump and period</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-clock text-primary"></i>
                <span class="fw-semibold">Shift Details</span>
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

                <form method="POST" action="{{ route('shifts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="pump_id" class="form-label fw-semibold">Select Pump <span class="text-danger">*</span></label>
                        <select class="form-select" name="pump_id" id="pump_id" required>
                            <option value="">-- Select a pump --</option>
                            @foreach($pumps as $pump)
                                <option value="{{ $pump->id }}" {{ old('pump_id') == $pump->id ? 'selected' : '' }}>
                                    {{ $pump->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pump_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="shift_period" class="form-label fw-semibold">Shift Period <span class="text-danger">*</span></label>
                        <select class="form-select" name="shift_period" id="shift_period" required>
                            <option value="morning" {{ old('shift_period') == 'morning' ? 'selected' : '' }}>Morning</option>
                            <option value="evening" {{ old('shift_period') == 'evening' ? 'selected' : '' }}>Evening</option>
                            <option value="night" {{ old('shift_period') == 'night' ? 'selected' : '' }}>Night</option>
                        </select>
                        @error('shift_period')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="opening_meter" class="form-label fw-semibold">Opening Meter Reading <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="opening_meter" id="opening_meter"
                               value="{{ old('opening_meter') }}" required placeholder="Enter meter reading in litres">
                        <small class="text-muted">Current meter reading at start of shift</small>
                        @error('opening_meter')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success flex-fill">
                            <i class="bi bi-play-circle me-2"></i>Open Shift
                        </button>
                        <a href="{{ route('shifts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
