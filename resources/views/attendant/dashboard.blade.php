@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-speedometer2 me-2"></i>My Dashboard</h1>
        <p>Quick access to record sales and view your recent activity</p>
    </div>
    <a href="{{ route('sales.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i>Record Sale
    </a>
</div>

@foreach($currentShifts as $shift)
    <div class="alert d-flex align-items-start gap-3 mb-4 border-0 rounded-3"
         style="background:{{ $shift->status === 'open' ? 'rgba(16,185,129,0.1)' : 'rgba(100,116,139,0.1)' }};border-left:4px solid {{ $shift->status === 'open' ? 'var(--success-green)' : 'var(--text-muted)' }}!important;">
        <i class="bi bi-clock-history fs-4 mt-1" style="color:{{ $shift->status === 'open' ? 'var(--success-green)' : 'var(--text-muted)' }};"></i>
        <div class="flex-fill">
            <div class="fw-semibold mb-1">
                Active Shift &mdash; {{ $shift->pump->name }} &mdash; {{ ucfirst($shift->shift_period) }}
                <span class="badge ms-2" style="background:{{ $shift->status === 'open' ? 'var(--success-green)' : '#64748b' }};">
                    {{ strtoupper($shift->status) }}
                </span>
            </div>
            @if($shift->status === 'closed')
                <div class="row g-3 mt-1">
                    <div class="col-auto"><small class="text-muted">Meter Litres:</small> <strong>{{ number_format($shift->meter_litres ?? 0, 2) }} L</strong></div>
                    <div class="col-auto"><small class="text-muted">System Litres:</small> <strong>{{ number_format($shift->system_litres ?? 0, 2) }} L</strong></div>
                    <div class="col-auto"><small class="text-muted">Difference:</small> <strong>{{ number_format($shift->difference ?? 0, 2) }} L</strong></div>
                    <div class="col-auto"><small class="text-muted">Total Amount:</small> <strong>TSH {{ number_format($shift->total_amount ?? 0, 2) }}</strong></div>
                </div>
            @endif
        </div>
    </div>
@endforeach

<div class="row g-4 mb-4">


    <div class="col-md-4">
        <div class="card stat-card border-start border-primary border-4 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px;background:rgba(37,99,235,0.1);flex-shrink:0;">
                    <i class="bi bi-cash-stack fs-4 text-primary"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Your Total Sales</p>
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
                    <i class="bi bi-droplet-half fs-4" style="color:var(--success-green);"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Litres Sold</p>
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
                    <i class="bi bi-receipt fs-4" style="color:var(--warning-amber);"></i>
                </div>
                <div>
                    <p class="text-uppercase fw-semibold mb-1" style="font-size:11px;letter-spacing:.5px;color:var(--text-muted);">Recent Entries</p>
                    <h3 class="fw-bold mb-0" style="color:var(--primary-navy);">{{ $mySales->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-receipt-cutoff text-primary"></i>
        <span class="fw-semibold">Your Recent Sales</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="recentSalesTable" class="table table-hover mb-0" style="width:100%">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th>Date</th>
                        <th>Pump</th>
                        <th>Fuel</th>
                        <th>Price/L (TSH)</th>
                        <th>Litres</th>
                        <th>Amount (TSH)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mySales as $sale)
                    <tr>
                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{ optional($sale->pump)->name }}
                            @if(optional($sale->pump)->code)
                                <small class="text-muted">({{ $sale->pump->code }})</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-secondary">{{ optional($sale->pump)->fuel_type ?? 'N/A' }}</span>
                        </td>
                        <td>{{ number_format(optional($sale->pump)->price_per_litre ?? 0, 2) }}</td>
                        <td>{{ $sale->litres_sold }} L</td>
                        <td><strong style="color:var(--success-green);">{{ number_format($sale->amount, 2) }}</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-3"></i><strong>No sales recorded yet</strong>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>


<script>
    // Enhanced Sales Chart & DataTable
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Trend Chart
        const salesCtx = document.getElementById('salesChart')?.getContext('2d');
        if (salesCtx && @json(!empty($sparkDates))) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: @json($sparkDates ?? []),
                    datasets: [{
                        label: 'Sales (TSH)',
                        data: @json($sparkValues ?? []),
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(37, 99, 235)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { intersect: false, mode: 'index' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: function(context) {
                                    return 'TSH ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: { grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { maxTicksLimit: 6 } },
                        y: { 
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: { 
                                callback: function(value) { return 'TSH ' + value.toLocaleString(); } 
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // DataTables for Recent Sales
        $('#recentSalesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, 'desc']],
            language: { search: 'Search sales:', emptyTable: 'No sales data available' },
            columnDefs: [
                { targets: 0, type: 'date' },
                { targets: 5, className: 'text-end' }
            ],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel']
        });
    });

    // Success toast for new sales
    @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            title: 'Success!',
            text: '{{ session("success") }}',
            icon: 'success',
            background: 'var(--success-green)',
            color: 'white'
        });
    @endif
</script>
@endsection

