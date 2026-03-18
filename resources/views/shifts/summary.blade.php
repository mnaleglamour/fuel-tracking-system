@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-file-earmark-text me-2"></i>Shift Summary</h1>
        <p>Complete summary for this shift</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('shifts.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Shifts
        </a>
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="bi bi-printer me-1"></i>Print
        </button>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-info-circle text-primary"></i>
        <span class="fw-semibold">Shift Information</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="p-3 rounded-3" style="background:#f8fafc;">
                    <small class="text-muted d-block mb-1">Pump</small>
                    <span class="fw-bold fs-6" style="color:var(--primary-navy);">{{ $shift->pump->name }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded-3" style="background:#f8fafc;">
                    <small class="text-muted d-block mb-1">Attendant</small>
                    <span class="fw-bold fs-6" style="color:var(--primary-navy);">{{ $shift->user->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-speedometer text-primary"></i>
        <span class="fw-semibold">Meter Reading</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-start border-primary border-3 h-100">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">Opening Meter</small>
                        <div class="fw-bold fs-4 text-primary">{{ number_format($shift->opening_meter ?? 0, 2) }}</div>
                        <small class="text-muted">Litres</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-primary border-3 h-100">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">Closing Meter</small>
                        <div class="fw-bold fs-4 text-primary">{{ number_format($shift->closing_meter ?? 0, 2) }}</div>
                        <small class="text-muted">Litres</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-4 h-100" style="border-color:var(--accent-blue)!important;">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">Litres Sold</small>
                        <div class="fw-bold fs-4" style="color:var(--accent-blue);">{{ number_format($shift->meter_litres ?? 0, 2) }}</div>
                        <small class="text-muted">Litres</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-cash-stack" style="color:var(--success-green);"></i>
        <span class="fw-semibold">Sales &amp; Amounts</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-start border-4 h-100" style="border-color:var(--success-green)!important;">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">System Litres Sold</small>
                        <div class="fw-bold fs-4" style="color:var(--success-green);">{{ number_format($shift->system_litres ?? 0, 2) }}</div>
                        <small class="text-muted">Litres</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-4 h-100" style="border-color:{{ ($shift->difference_litres ?? 0) < 0 ? 'var(--danger-red)' : 'var(--warning-amber)' }}!important;">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">Difference</small>
                        <div class="fw-bold fs-4" style="color:{{ ($shift->difference_litres ?? 0) < 0 ? 'var(--danger-red)' : 'var(--warning-amber)' }};">
                            {{ number_format($shift->difference_litres ?? 0, 2) }}
                        </div>
                        <small class="text-muted">Litres</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-primary border-4 h-100">
                    <div class="card-body py-3 text-center">
                        <small class="text-muted d-block mb-1">Total Amount</small>
                        <div class="fw-bold fs-4 text-primary">{{ number_format($shift->total_amount ?? 0, 2) }}</div>
                        <small class="text-muted">TSH</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
