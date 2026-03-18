@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2"></i>Create Pump</h1>
    <p>Add a new fuel pump to the system</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-fuel-pump text-primary"></i>
                <span class="fw-semibold">Pump Information</span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.pumps.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pump Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required placeholder="e.g. Pump A">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Code <span class="text-muted fw-normal">(optional)</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                   name="code" value="{{ old('code') }}" placeholder="e.g. P001">
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Region <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('region') is-invalid @enderror"
                                   name="region" value="{{ old('region') }}" required placeholder="e.g. Mwanza, Dar es Salaam">
                            <small class="text-muted">Must match a region in the uploaded government cap prices</small>
                            @error('region') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fuel Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fuel_type') is-invalid @enderror"
                                   name="fuel_type" value="{{ old('fuel_type') }}" required placeholder="e.g. PETROL, DIESEL">
                            @error('fuel_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Price per Litre <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">TSH</span>
                                <input type="number" step="0.01" min="0" class="form-control @error('price_per_litre') is-invalid @enderror"
                                       name="price_per_litre" value="{{ old('price_per_litre') }}" required>
                            </div>
                            @error('price_per_litre') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Initial Stock (Litres) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control @error('stock') is-invalid @enderror"
                                       name="stock" value="{{ old('stock') }}" required>
                                <span class="input-group-text">L</span>
                            </div>
                            @error('stock') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Low Stock Threshold <span class="text-muted fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control @error('low_stock_threshold') is-invalid @enderror"
                                       name="low_stock_threshold" value="{{ old('low_stock_threshold') }}" placeholder="e.g. 500">
                                <span class="input-group-text">L</span>
                            </div>
                            <small class="text-muted">Alert when stock falls below this level</small>
                            @error('low_stock_threshold') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-success flex-fill">
                            <i class="bi bi-plus-circle me-2"></i>Create Pump
                        </button>
                        <a href="{{ route('admin.pumps.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
