@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-fuel-pump me-2"></i>Pumps</h1>
        <p>Manage all fuel pumps and their configurations</p>
    </div>
    <a href="{{ route('admin.pumps.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i>Create Pump
    </a>
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
        <span class="fw-semibold">All Pumps</span>
        <span class="badge bg-secondary ms-1">{{ $pumps->total() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th class="text-white px-4 py-3">Name / Code</th>
                        <th class="text-white px-4 py-3">Region</th>
                        <th class="text-white px-4 py-3">Fuel Type</th>
                        <th class="text-white px-4 py-3">Price / L</th>
                        <th class="text-white px-4 py-3">Stock</th>
                        <th class="text-white px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pumps as $pump)
                    @php $isLow = !is_null($pump->low_stock_threshold) && $pump->stock <= $pump->low_stock_threshold; @endphp
                    <tr>
                        <td class="px-4 py-3">
                            <span class="fw-semibold" style="color:var(--primary-navy);">{{ $pump->name }}</span>
                            @if($pump->code)
                                <span class="badge bg-light text-muted ms-1">{{ $pump->code }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <i class="bi bi-geo-alt text-muted me-1"></i>{{ $pump->region ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="badge rounded-pill bg-secondary">{{ $pump->fuel_type }}</span>
                        </td>
                        <td class="px-4 py-3 fw-semibold">TSH {{ number_format($pump->price_per_litre, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="fw-bold" style="color:{{ $isLow ? 'var(--danger-red)' : 'var(--success-green)' }};">
                                {{ number_format($pump->stock, 0) }} L
                            </span>
                            @if($isLow)
                                <span class="badge bg-danger ms-1">LOW</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.pumps.edit', $pump) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.pumps.destroy', $pump) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete pump {{ $pump->name }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-fuel-pump fs-3 d-block mb-2"></i>No pumps found.
                            <a href="{{ route('admin.pumps.create') }}" class="d-block mt-2">Create your first pump</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white px-4 py-3">
        {{ $pumps->links() }}
    </div>
</div>
@endsection
