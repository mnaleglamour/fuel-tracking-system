@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-download me-2"></i>Download Sales Report</h1>
    <p>Export your sales data in CSV format</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="bi bi-file-earmark-spreadsheet text-primary"></i>
                <span class="fw-semibold">Export Options</span>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info mb-4" role="alert" style="font-size:13px;">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Export includes:</strong> Date, Pump, Region, Fuel Type, Price/L, Litres Sold, Amount, and Attendant.
                </div>

                <form method="GET" action="{{ route('sales.download') }}">
                    <div class="mb-3">
                        <label for="timeframe" class="form-label fw-semibold">Select Period</label>
                        <select name="timeframe" id="timeframe" class="form-select" onchange="toggleCustomDates()">
                            <option value="all">All Records</option>
                            <option value="today">Today Only</option>
                            <option value="week">Last 7 Days</option>
                            <option value="month">This Month</option>
                            <option value="custom">Custom Date Range</option>
                        </select>
                    </div>

                    <div id="custom-dates" style="display:none;">
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="end_date" class="form-label fw-semibold">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success flex-fill">
                            <i class="bi bi-file-earmark-arrow-down me-2"></i>Download CSV
                        </button>
                        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleCustomDates() {
    const val = document.getElementById('timeframe').value;
    document.getElementById('custom-dates').style.display = val === 'custom' ? 'block' : 'none';
}
</script>
@endsection
