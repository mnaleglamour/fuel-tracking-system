@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h4 class="mb-0 fw-bold" style="color:var(--primary-navy)">Profile Settings</h4>
        <p class="text-muted mb-0 small">Manage your account information and security</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header border-0 py-3 px-4" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-person-circle me-2" style="color:var(--accent-blue)"></i>Profile Information
                    </h6>
                </div>
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header border-0 py-3 px-4" style="background:var(--bg-light)">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary-navy)">
                        <i class="bi bi-lock me-2" style="color:var(--warning-amber)"></i>Update Password
                    </h6>
                </div>
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card border-0 shadow-sm border-danger" style="border-color:var(--danger-red)!important">
                <div class="card-header border-0 py-3 px-4" style="background:#fff5f5">
                    <h6 class="mb-0 fw-semibold" style="color:var(--danger-red)">
                        <i class="bi bi-exclamation-triangle me-2"></i>Danger Zone
                    </h6>
                </div>
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3"
                    style="width:80px;height:80px;background:var(--accent-blue);font-size:32px">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h6 class="fw-bold mb-1" style="color:var(--primary-navy)">{{ Auth::user()->name }}</h6>
                <p class="text-muted small mb-2">{{ Auth::user()->email }}</p>
                @if(Auth::user()->isAdmin())
                    <span class="badge" style="background:var(--accent-blue)">Admin</span>
                @else
                    <span class="badge" style="background:var(--success-green)">Attendant</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
