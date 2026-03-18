@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-graph-up me-2"></i>All Sales</h1>
        <p>View and manage all recorded fuel sales</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-table text-primary"></i>
        <span class="fw-semibold">Sales Records</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th class="text-white px-4 py-3">Date</th>
                        <th class="text-white px-4 py-3">Pump</th>
                        <th class="text-white px-4 py-3">Fuel</th>
                        <th class="text-white px-4 py-3">Litres</th>
                        <th class="text-white px-4 py-3">Amount (TSH)</th>
                        <th class="text-white px-4 py-3">Attendant</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td class="px-4 py-3" style="font-size:13px;">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 fw-semibold">{{ optional($sale->pump)->name }}</td>
                        <td class="px-4 py-3">
                            <span class="badge rounded-pill bg-secondary">{{ optional($sale->pump)->fuel_type ?? 'N/A' }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $sale->litres_sold }} L</td>
                        <td class="px-4 py-3 fw-semibold" style="color:var(--success-green);">{{ number_format($sale->amount, 2) }}</td>
                        <td class="px-4 py-3">{{ optional($sale->user)->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No sales found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(isset($sales) && method_exists($sales, 'links'))
    <div class="card-footer bg-white px-4 py-3">
        {{ $sales->links() }}
    </div>
    @endif
</div>
@endsection
