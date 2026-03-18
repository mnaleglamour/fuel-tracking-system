<x-guest-layout>
    <div class="auth-header">
        <h1>
            <i class="bi bi-key" style="color: var(--accent-blue);"></i>
            Forgot Password?
        </h1>
        <p>Enter your email to receive a password reset link</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope"></i>
                Send Reset Link
            </button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="btn-link">
                <i class="bi bi-arrow-left"></i>
                Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
