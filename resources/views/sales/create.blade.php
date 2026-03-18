@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2"></i>Record Sale</h1>
    <p>Submit a new fuel sale transaction</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-receipt text-primary"></i>
                <span class="fw-semibold">Sale Details</span>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

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

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pump_id" class="form-label fw-semibold">Select Pump <span class="text-danger">*</span></label>
                        <select class="form-select" name="pump_id" id="pump_id" required onchange="updatePumpInfo()">
                            <option value="">-- Select a pump --</option>
                            @foreach($pumps as $pump)
                                <option value="{{ $pump->id }}"
                                        data-price="{{ $pump->price_per_litre }}"
                                        data-region="{{ $pump->region }}"
                                        data-fuel="{{ $pump->fuel_type }}"
                                        data-cap="{{ $pump->cap_price ?? '' }}"
                                        {{ old('pump_id') == $pump->id ? 'selected' : '' }}>
                                    {{ $pump->name }} &mdash; {{ $pump->fuel_type }} &mdash; Stock: {{ $pump->stock ?? 'N/A' }} L
                                </option>
                            @endforeach
                        </select>
                        @error('pump_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="pumpInfo" class="rounded-3 p-3 mb-3" style="display:none;background:#f0f9ff;border-left:4px solid var(--accent-blue);">
                        <div class="row g-2" style="font-size:13px;">
                            <div class="col-6">
                                <span class="text-muted">Region:</span>
                                <strong id="infoPumpRegion" class="ms-1">-</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-muted">Pump Price:</span>
                                <strong id="infoPumpPrice" class="ms-1 text-primary">0.00</strong>
                                <span class="text-muted">/L</span>
                            </div>
                            <div class="col-12">
                                <span class="text-muted">Gov Cap Price:</span>
                                <strong id="infoCapPrice" class="ms-1" style="color:var(--success-green);">-</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="litres_sold" class="form-label fw-semibold">Litres Sold <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="litres_sold" id="litres_sold"
                               value="{{ old('litres_sold') }}" required placeholder="Enter quantity in litres">
                        <small class="text-muted">Enter the number of litres dispensed</small>
                        @error('litres_sold')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success flex-fill">
                            <i class="bi bi-check-circle me-2"></i>Submit Sale
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updatePumpInfo() {
    const select = document.getElementById('pump_id');
    const option = select.options[select.selectedIndex];
    const pumpInfo = document.getElementById('pumpInfo');
    if (!option.value) { pumpInfo.style.display = 'none'; return; }
    pumpInfo.style.display = 'block';
    document.getElementById('infoPumpRegion').textContent = option.getAttribute('data-region') || '-';
    document.getElementById('infoPumpPrice').textContent = parseFloat(option.getAttribute('data-price') || 0).toFixed(2);
    const cap = option.getAttribute('data-cap');
    const capEl = document.getElementById('infoCapPrice');
    if (!cap) {
        capEl.textContent = 'Not set';
        capEl.style.color = 'var(--danger-red)';
    } else {
        capEl.textContent = 'TSH ' + parseFloat(cap).toFixed(2) + '/L';
        capEl.style.color = 'var(--success-green)';
    }
}
</script>
@endsection
