@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold" style="color:var(--primary-navy)">Government Cap Prices</h4>
            <p class="text-muted mb-0 small">Upload and view official fuel price caps by region</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {!! nl2br(e(session('error'))) !!}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul class="mb-0 ps-3 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-5">
            @if($pumpRegions->count() > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3" style="color:var(--primary-navy)">
                        <i class="bi bi-funnel me-2" style="color:var(--accent-blue)"></i>Filter by Region
                    </h6>
                    <form method="GET" action="{{ route('admin.govcap.upload') }}" class="d-flex gap-2">
                        <select name="region" id="region-filter" class="form-select">
                            <option value="all">All Pump Regions</option>
                            @foreach($pumpRegions as $region)
                                <option value="{{ $region }}" @if($selectedRegion === $region) selected @endif>{{ $region }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn text-white fw-semibold px-4" style="background:var(--accent-blue);white-space:nowrap">
                            Filter
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 py-3 px-4" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-cloud-upload me-2" style="color:var(--success-green)"></i>Upload Cap Prices
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info d-flex gap-2 mb-4 p-3" style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px">
                        <i class="bi bi-info-circle-fill mt-1 flex-shrink-0" style="color:var(--accent-blue)"></i>
                        <div class="small" style="color:#1e40af">
                            <strong>Required File Format:</strong><br>
                            Your Excel/CSV must have columns in this order:<br><br>
                            <strong>Column A:</strong> S/NO &nbsp;|&nbsp;
                            <strong>Column B:</strong> TOWN<br>
                            <strong>Column C:</strong> PETROL &nbsp;|&nbsp;
                            <strong>Column D:</strong> DIESEL<br>
                            <strong>Column E:</strong> KEROSENE<br><br>
                            Prices may include commas or currency symbols.<br>
                            Headers are auto-detected (row 1 or 2).<br>
                            Supported: <em>.xlsx, .xls, .csv</em>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.govcap.upload.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="gov_cap_file" class="form-label fw-semibold">
                                Select File <span class="text-danger">*</span>
                            </label>
                            <input type="file" id="gov_cap_file" name="gov_cap_file"
                                accept=".xlsx,.xls,.csv"
                                class="form-control" required>
                            <div class="form-text">Supported: .xlsx (Excel) or .csv (Comma-separated)</div>
                        </div>
                        <button type="submit" class="btn text-white fw-semibold" style="background:var(--success-green)">
                            <i class="bi bi-cloud-upload me-1"></i> Upload Prices
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            @if(!empty($latestPrices))
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 py-3 px-4" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-grid-3x3-gap me-2" style="color:var(--warning-amber)"></i>Current Cap Prices by Region
                    </h6>
                </div>
                <div class="card-body p-4">
                    @foreach($latestPrices as $region => $fuelTypes)
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3 d-flex align-items-center gap-2" style="color:var(--secondary-navy)">
                                <i class="bi bi-geo-alt-fill" style="color:var(--accent-blue)"></i>
                                {{ $region }}
                            </h6>
                            <div class="row g-2">
                                @foreach($fuelTypes as $fuelType => $prices)
                                    @php $latestPrice = $prices->sortByDesc('effective_date')->first(); @endphp
                                    <div class="col-sm-4">
                                        <div class="p-3 rounded border-start border-3" style="background:var(--bg-light);border-color:var(--accent-blue)!important">
                                            <div class="text-muted small text-uppercase fw-semibold mb-1">{{ $fuelType }}</div>
                                            <div class="fw-bold fs-5" style="color:var(--primary-navy)">
                                                TSH {{ number_format($latestPrice->cap_price, 2) }}
                                            </div>
                                            <div class="text-muted" style="font-size:11px;margin-top:4px">
                                                Updated: {{ \Carbon\Carbon::parse($latestPrice->effective_date)->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if(!$loop->last)<hr class="my-3">@endif
                    @endforeach
                </div>
            </div>
            @else
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-5 text-center">
                    <i class="bi bi-table mb-3" style="font-size:3rem;color:var(--border-color)"></i>
                    <h6 class="fw-semibold text-muted">No cap prices available</h6>
                    <p class="text-muted small">Upload an Excel or CSV file to display prices here.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
