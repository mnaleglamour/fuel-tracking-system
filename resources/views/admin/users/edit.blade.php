@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="mb-0 fw-bold" style="color:var(--primary-navy)">Edit User Role</h4>
                    <p class="text-muted mb-0 small">Manage role for {{ $user->name }}</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger d-flex align-items-center mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Name</label>
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:var(--bg-light)">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                    style="width:40px;height:40px;background:var(--accent-blue);font-size:15px;flex-shrink:0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold" style="color:var(--primary-navy)">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="{{ \App\Models\User::ROLE_ATTENDANT }}"
                                    {{ $user->role === \App\Models\User::ROLE_ATTENDANT ? 'selected' : '' }}>
                                    Attendant
                                </option>
                                <option value="{{ \App\Models\User::ROLE_ADMIN }}"
                                    {{ $user->role === \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Changing this will affect what this user can access in the system.</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn text-white fw-semibold" style="background:var(--accent-blue)">
                                <i class="bi bi-check-lg me-1"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
