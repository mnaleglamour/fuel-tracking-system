<x-guest-layout>
    <div class="auth-header">
        <h1>
            <i class="bi bi-box-arrow-in-right" style="color: var(--accent-blue);"></i>
            Sign In
        </h1>
        <p>Enter your credentials to access your dashboard</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me" style="font-weight: 400;">
                Remember me
            </label>
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right"></i>
                Sign In
            </button>
        </div>

        <div class="text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn-link">
                    Forgot your password?
                </a>
            @endif
        </div>

        <hr style="margin: 25px 0; border-color: var(--border-color);">

        <div class="text-center">
            <span style="color: var(--text-muted); font-size: 14px;">Don't have an account?</span>
            <a href="{{ route('register') }}" style="font-size: 14px;">Create Account</a>
        </div>
    </form>
</x-guest-layout>
