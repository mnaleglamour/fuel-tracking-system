@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</h1>
        <p>Overview of sales, fuel stock, recent activity &amp; government cap prices</p>
    </div>
    <span class="text-muted" style="font-size:13px;"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}</span>
</div>

<div class="row g-4 mb-4">

    <div class="col-lg-4">
        <div class="row g-3 h-100">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-pie-chart fs-1 text-primary mb-2 opacity-75"></i>
                        <h5 class="fw-bold text-primary mb-1">{{ $pumps->count() }}</h5>
                        <p class="text-muted mb-0 small">Total Pumps</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card border-start border-primary border-4 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px;background:rgba(37,99,235,0.1);flex-shrink:0;">
                    <i class="bi bi-cash-stack fs-4 text-primary"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Total Sales</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">TSH {{ number_format($totalSales, 2) }}</h3>
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
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Total Pumps</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">{{ $pumps->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-fuel-pump text-primary"></i>
            <span class="fw-semibold">Pump Stock &amp; Pricing by Region</span>
        </div>
        <button id="toggleAllPumps" onclick="toggleAllPumps()" class="btn btn-primary btn-sm">
            <i class="bi bi-list-ul me-1"></i>Show All Pumps
        </button>
    </div>
    <div class="card-body">
        <div id="initialPumps">
            <div class="row g-3">
                @forelse($pumps->take(3) as $pump)
                    @php
                        $capPrice = $pump->cap_price ?? null;
                        $isAboveCap = $capPrice && $pump->price_per_litre > $capPrice;
                        $isLowStock = !is_null($pump->low_stock_threshold) && $pump->stock <= $pump->low_stock_threshold;
                        $borderColor = $isLowStock ? 'var(--danger-red)' : ($isAboveCap ? '#f87171' : 'var(--accent-blue)');
                    @endphp
                    <div class="col-md-4">
                        <div class="rounded-3 p-3" style="background:#f8fafc;border-left:5px solid {{ $borderColor }};">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="fw-bold" style="color:var(--primary-navy);">{{ $pump->name }}</div>
                                    <div style="font-size:12px;color:var(--text-muted);"><i class="bi bi-geo-alt me-1"></i>{{ $pump->region ?? 'No Region' }}</div>
                                </div>
                                <span class="badge bg-secondary rounded-pill">{{ $pump->fuel_type }}</span>
                            </div>
                            <div class="rounded-2 p-2 mb-2" style="background:#fff;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Current Stock:</small>
                                    <span class="fw-bold" style="color:{{ $isLowStock ? 'var(--danger-red)' : 'var(--success-green)' }};font-size:15px;">
                                        {{ number_format($pump->stock, 0) }} L
                                    </span>
                                </div>
                                @if($pump->low_stock_threshold)
                                    <div style="font-size:11px;color:var(--text-muted);">
                                        Threshold: {{ $pump->low_stock_threshold }} L
                                        @if($isLowStock)
                                            <span class="badge bg-danger ms-1">LOW</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div style="border-top:1px solid #e5e7eb;padding-top:10px;">
                                <div style="font-size:12px;color:var(--text-muted);">Current Price:</div>
                                <div class="fw-bold" style="font-size:15px;color:var(--primary-navy);">TSH {{ number_format($pump->price_per_litre, 2) }}/L</div>
                                @if($capPrice)
                                    <div class="rounded-2 p-2 mt-2" style="background:#dbeafe;font-size:11px;">
                                        <div style="color:#0c4a6e;">Cap Price: TSH {{ number_format($capPrice, 2) }}/L</div>
                                        <div class="fw-semibold" style="color:var(--success-green);">
                                            @if($isAboveCap) ABOVE CAP (+{{ number_format($pump->price_per_litre - $capPrice, 2) }})
                                            @else WITHIN CAP (-{{ number_format($capPrice - $pump->price_per_litre, 2) }}) @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-2 p-2 mt-2" style="background:#f3f4f6;font-size:11px;color:#9ca3af;"><em>No cap price data</em></div>
                                @endif
                            </div>
                            @if($pump->code)
                                <div class="mt-2" style="font-size:11px;color:#9ca3af;border-top:1px solid #e5e7eb;padding-top:8px;">Code: <strong>{{ $pump->code }}</strong></div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        <i class="bi bi-fuel-pump fs-3 d-block mb-2"></i>No pumps in the system
                    </div>
                @endforelse
            </div>
        </div>

        <div id="allPumpsSection" style="display:none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <small class="text-muted">Showing all {{ $pumps->count() }} pumps</small>
                <button onclick="toggleAllPumps()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-x-lg me-1"></i>Hide
                </button>
            </div>
            <div class="row g-3">
                @forelse($pumps as $pump)
                    @php
                        $capPrice = $pump->cap_price ?? null;
                        $isAboveCap = $capPrice && $pump->price_per_litre > $capPrice;
                        $isLowStock = !is_null($pump->low_stock_threshold) && $pump->stock <= $pump->low_stock_threshold;
                        $borderColor = $isLowStock ? 'var(--danger-red)' : ($isAboveCap ? '#f87171' : 'var(--accent-blue)');
                    @endphp
                    <div class="col-md-4">
                        <div class="rounded-3 p-3" style="background:#f8fafc;border-left:5px solid {{ $borderColor }};">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="fw-bold" style="color:var(--primary-navy);">{{ $pump->name }}</div>
                                    <div style="font-size:12px;color:var(--text-muted);"><i class="bi bi-geo-alt me-1"></i>{{ $pump->region ?? 'No Region' }}</div>
                                </div>
                                <span class="badge bg-secondary rounded-pill">{{ $pump->fuel_type }}</span>
                            </div>
                            <div class="rounded-2 p-2 mb-2" style="background:#fff;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Current Stock:</small>
                                    <span class="fw-bold" style="color:{{ $isLowStock ? 'var(--danger-red)' : 'var(--success-green)' }};font-size:15px;">
                                        {{ number_format($pump->stock, 0) }} L
                                    </span>
                                </div>
                                @if($pump->low_stock_threshold)
                                    <div style="font-size:11px;color:var(--text-muted);">
                                        Threshold: {{ $pump->low_stock_threshold }} L
                                        @if($isLowStock) <span class="badge bg-danger ms-1">LOW</span> @endif
                                    </div>
                                @endif
                            </div>
                            <div style="border-top:1px solid #e5e7eb;padding-top:10px;">
                                <div style="font-size:12px;color:var(--text-muted);">Current Price:</div>
                                <div class="fw-bold" style="font-size:15px;color:var(--primary-navy);">TSH {{ number_format($pump->price_per_litre, 2) }}/L</div>
                                @if($capPrice)
                                    <div class="rounded-2 p-2 mt-2" style="background:#dbeafe;font-size:11px;">
                                        <div style="color:#0c4a6e;">Cap: TSH {{ number_format($capPrice, 2) }}/L</div>
                                        <div class="fw-semibold" style="color:var(--success-green);">
                                            @if($isAboveCap) ABOVE (+{{ number_format($pump->price_per_litre - $capPrice, 2) }})
                                            @else WITHIN (-{{ number_format($capPrice - $pump->price_per_litre, 2) }}) @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-2 p-2 mt-2" style="background:#f3f4f6;font-size:11px;color:#9ca3af;"><em>No cap data</em></div>
                                @endif
                            </div>
                            @if($pump->code)
                                <div class="mt-2" style="font-size:11px;color:#9ca3af;border-top:1px solid #e5e7eb;padding-top:8px;">Code: <strong>{{ $pump->code }}</strong></div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted"><i class="bi bi-fuel-pump fs-3 d-block mb-2"></i>No pumps found</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@if(!empty($lowStockPumps) && $lowStockPumps->count())
<div class="card mb-4 border-start border-danger border-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-exclamation-triangle-fill text-danger"></i>
        <span class="fw-semibold text-danger">Low Stock Alerts</span>
        <span class="badge bg-danger ms-1">{{ $lowStockPumps->count() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @foreach($lowStockPumps as $lp)
                @php $capPrice = $lp->cap_price ?? null; $isAboveCap = $capPrice && $lp->price_per_litre > $capPrice; @endphp
                <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                    <div>
                        <span class="fw-semibold">{{ $lp->name }} {{ $lp->code ? '('.$lp->code.')' : '' }}</span>
                        <div style="font-size:12px;color:var(--text-muted);">
                            TSH {{ number_format($lp->price_per_litre, 2) }}/L
                            @if($capPrice)
                                <span style="color:{{ $isAboveCap ? 'var(--danger-red)' : 'var(--text-muted)' }}">
                                    &bull; Cap: TSH {{ number_format($capPrice, 2) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-danger rounded-pill">{{ $lp->stock }} L</span>
                        <a href="{{ route('admin.pumps.edit', $lp) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i>Manage
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-graph-up text-primary"></i>
        <span class="fw-semibold">Recent Sales</span>
    </div>
    <div class="card-body p-0">
    <div class="table-responsive">
            <table id="adminSalesTable" class="table table-hover mb-0" style="width:100%">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th>Date</th>
                        <th>Pump</th>
                        <th>Fuel</th>
                        <th>Price/L</th>
                        <th>Litres</th>
                        <th class="text-end">Amount</th>
                        <th>Attendant</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{ optional($sale->pump)->name }}
                            @if(optional($sale->pump)->code)
                                <small class="text-muted">({{ $sale->pump->code }})</small>
                            @endif
                        </td>
                        <td><span class="badge rounded-pill bg-secondary">{{ optional($sale->pump)->fuel_type }}</span></td>
                        <td>{{ number_format(optional($sale->pump)->price_per_litre ?? 0, 2) }}</td>
                        <td>{{ $sale->litres_sold }} L</td>
                        <td class="text-end fw-bold" style="color:var(--success-green);">{{ number_format($sale->amount, 2) }}</td>
                        <td>{{ optional($sale->user)->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No recent sales
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center px-4 py-3" style="border-top:1px solid var(--border-color);">
            <span class="text-muted" style="font-size:13px;" id="recentSalesInfo">&nbsp;</span>
            <div class="btn-group btn-group-sm">
                <button id="recentPrev" class="btn btn-outline-secondary"><i class="bi bi-chevron-left"></i> Prev</button>
                <button id="recentNext" class="btn btn-outline-secondary">Next <i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Admin Sales Chart
    const adminCtx = document.getElementById('adminSalesChart')?.getContext('2d');
    if (adminCtx) {
        const dates = @json($dates ?? []);
        const amounts = @json($chartAmounts ?? []);
        const litres = @json($chartLitres ?? []);
        if (dates.length > 0) {
            new Chart(adminCtx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Sales (TSH)',
                        data: amounts,
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        yAxisID: 'y',
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Litres',
                        data: litres,
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        yAxisID: 'y1',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    interaction: { mode: 'nearest', intersect: false },
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        x: { grid: { color: 'rgba(0,0,0,0.05)' } },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: { display: true, text: 'Sales (TSH)', color: 'rgb(37, 99, 235)' }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: { drawOnChartArea: false },
                            title: { display: true, text: 'Litres (L)', color: 'rgb(16, 185, 129)' }
                        }
                    }
                }
            });
        }
    }

    // Admin Recent Sales DataTable
    $('#adminSalesTable').DataTable({
        responsive: true,
        pageLength: 10,
        dom: 'Bfrtip',
        order: [[0, 'desc']],
        columnDefs: [{ targets: 0, type: 'datetime' }, { targets: 5, className: 'text-end' }],
        buttons: ['copy', 'csv', 'excel', 'colvis']
    });
});

function toggleAllPumps() {
    const initialPumps = document.getElementById('initialPumps');

    const allPumpsSection = document.getElementById('allPumpsSection');
    const toggleBtn = document.getElementById('toggleAllPumps');
    if (allPumpsSection.style.display === 'none') {
        initialPumps.style.display = 'none';
        allPumpsSection.style.display = 'block';
        toggleBtn.innerHTML = '<i class="bi bi-list-ul me-1"></i>Show Less';
    } else {
        initialPumps.style.display = 'block';
        allPumpsSection.style.display = 'none';
        toggleBtn.innerHTML = '<i class="bi bi-list-ul me-1"></i>Show All Pumps';
    }
}
</script>
@endsection
