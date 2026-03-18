@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-house-door me-2"></i>Dashboard</h1>
    <p>Welcome back, {{ Auth::user()->name }}. Here's your overview.</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card border-start border-primary border-4 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px;background:rgba(37,99,235,0.1);flex-shrink:0;">
                    <i class="bi bi-currency-dollar fs-4 text-primary"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Total Sales</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">TSH {{ number_format($totalSales, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card border-start border-4 h-100" style="border-color:var(--success-green)!important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px;background:rgba(16,185,129,0.1);flex-shrink:0;">
                    <i class="bi bi-droplet fs-4" style="color:var(--success-green);"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Total Litres</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">{{ $totalLitres }} L</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card border-start border-4 h-100" style="border-color:var(--warning-amber)!important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px;background:rgba(245,158,11,0.1);flex-shrink:0;">
                    <i class="bi bi-fuel-pump fs-4" style="color:var(--warning-amber);"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Fuel Types</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">{{ $fuels->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-fuel-pump text-primary"></i>
        <span class="fw-semibold">Fuel Stock</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th class="text-white px-4 py-3">Fuel</th>
                        <th class="text-white px-4 py-3">Price per Litre</th>
                        <th class="text-white px-4 py-3">Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fuels as $fuel)
                    <tr>
                        <td class="px-4 py-3 fw-semibold">{{ $fuel->name }}</td>
                        <td class="px-4 py-3">TSH {{ number_format($fuel->price_per_litre, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="badge rounded-pill" style="background:var(--success-green);">
                                {{ $fuel->current_stock }} L
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>No fuel data available
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-end">
    <a href="{{ route('sales.create') }}" class="btn btn-success px-4">
        <i class="bi bi-plus-circle me-2"></i>Record Sale
    </a>
</div>
@endsection
