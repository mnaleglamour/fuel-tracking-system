<x-guest-layout>
    <div class="auth-header">
        <h1>
            <i class="bi bi-shield-check" style="color: var(--accent-blue);"></i>
            Confirm Password
        </h1>
        <p>Please confirm your password before continuing</p>
    </div>

    <div class="alert alert-warning" role="alert" style="font-size: 14px;">
        <i class="bi bi-exclamation-triangle"></i>
        This is a secure area. Please confirm your password before continuing.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle"></i>
                Confirm
            </button>
        </div>
    </form>
</x-guest-layout>
