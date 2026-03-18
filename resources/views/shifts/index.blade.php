@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-clock-history me-2"></i>Shifts Management</h1>
        <p>Manage and view all pump shifts</p>
    </div>
    @if(Auth::user()->isAttendant())
        <div>
            <a href="{{ route('shifts.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Open New Shift
            </a>
            <p class="text-muted mt-2" style="font-size:13px;"><i class="bi bi-info-circle me-1"></i>Open a shift before recording sales</p>
        </div>
    @endif
</div>

@if(Auth::user()->isAdmin())
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-info-circle me-2"></i>You are viewing all shifts across all attendants and pumps.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@forelse($shifts as $shift)
    <div class="card mb-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" role="button"
             onclick="toggleShift('shift-{{ $shift->id }}')" style="cursor:pointer;">
            <div class="row w-100 g-3 align-items-center">
                <div class="col-md-3">
                    <small class="text-muted d-block" style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Pump</small>
                    <span class="fw-bold" style="color:var(--primary-navy);">{{ $shift->pump->name }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block" style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Attendant</small>
                    <span class="fw-semibold">{{ $shift->user->name }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block" style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Period</small>
                    <span class="badge rounded-pill bg-secondary">{{ ucfirst($shift->shift_period) }}</span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block" style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Status</small>
                    @if($shift->status === 'open')
                        <span class="badge rounded-pill" style="background:var(--success-green);">OPEN</span>
                    @else
                        <span class="badge rounded-pill bg-secondary">CLOSED</span>
                    @endif
                </div>
            </div>
            <i class="bi bi-chevron-down ms-3 shift-chevron" id="chevron-{{ $shift->id }}" style="transition:.3s;flex-shrink:0;"></i>
        </div>

        <div id="shift-{{ $shift->id }}" style="display:none;">
            <div class="card-body border-top pt-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc;">
                            <small class="text-muted d-block mb-1">Shift Period</small>
                            <span class="fw-semibold">{{ ucfirst($shift->shift_period) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc;">
                            <small class="text-muted d-block mb-1">Opened At</small>
                            <span class="fw-semibold">{{ optional($shift->opened_at)?->format('d M Y H:i') ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @if($shift->status === 'closed')
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8fafc;">
                            <small class="text-muted d-block mb-1">Closed At</small>
                            <span class="fw-semibold">{{ optional($shift->closed_at)?->format('d M Y H:i') ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                @if($shift->status === 'closed')
                    <div class="row g-3 mb-4">
                        <div class="col-12"><h6 class="fw-bold" style="color:var(--primary-navy);">Meter Reading</h6></div>
                        <div class="col-md-4">
                            <div class="card border-start border-primary border-3">
                                <div class="card-body py-3">
                                    <small class="text-muted">Opening Meter</small>
                                    <div class="fw-bold fs-5 text-primary">{{ number_format($shift->opening_meter ?? 0, 2) }} L</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-start border-primary border-3">
                                <div class="card-body py-3">
                                    <small class="text-muted">Closing Meter</small>
                                    <div class="fw-bold fs-5 text-primary">{{ number_format($shift->closing_meter ?? 0, 2) }} L</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-start border-4" style="border-color:var(--accent-blue)!important;">
                                <div class="card-body py-3">
                                    <small class="text-muted">Meter Litres</small>
                                    <div class="fw-bold fs-5" style="color:var(--accent-blue);">{{ number_format($shift->meter_litres ?? 0, 2) }} L</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12"><h6 class="fw-bold" style="color:var(--primary-navy);">Sales Summary</h6></div>
                        <div class="col-md-4">
                            <div class="card border-start border-4" style="border-color:var(--success-green)!important;">
                                <div class="card-body py-3">
                                    <small class="text-muted">System Litres Sold</small>
                                    <div class="fw-bold fs-5" style="color:var(--success-green);">{{ number_format($shift->system_litres ?? 0, 2) }} L</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-start border-4" style="border-color:var(--success-green)!important;">
                                <div class="card-body py-3">
                                    <small class="text-muted">Total Amount</small>
                                    <div class="fw-bold fs-5" style="color:var(--success-green);">TSH {{ number_format($shift->total_amount ?? 0, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('shifts.download-pdf', $shift) }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-file-earmark-pdf me-2"></i>Download PDF
                        </a>
                    </div>
                @else
                    @if(Auth::user()->isAttendant() && Auth::user()->id === $shift->user_id)
                        <a href="{{ route('shifts.close.form', $shift) }}" class="btn btn-danger">
                            <i class="bi bi-stop-circle me-2"></i>Close Shift
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-clock-history fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">No shifts found</h5>
            @if(Auth::user()->isAttendant())
                <a href="{{ route('shifts.create') }}" class="btn btn-success mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Open Your First Shift
                </a>
            @endif
        </div>
    </div>
@endforelse

<script>
function toggleShift(id) {
    const el = document.getElementById(id);
    const shiftId = id.replace('shift-', '');
    const chevron = document.getElementById('chevron-' + shiftId);
    if (el.style.display === 'none') {
        el.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
    } else {
        el.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection
