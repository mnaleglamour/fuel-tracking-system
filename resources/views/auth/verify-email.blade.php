<x-guest-layout>
    <div class="auth-header">
        <h1>
            <i class="bi bi-envelope-check" style="color: var(--accent-blue);"></i>
            Verify Email
        </h1>
        <p>Please verify your email address to continue</p>
    </div>

    <div class="alert alert-info" role="alert">
        <i class="bi bi-info-circle"></i>
        Thanks for signing up! Before getting started, please verify your email address by clicking the link we sent you. If you didn't receive the email, we'll gladly send you another.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle"></i>
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
        @csrf

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope"></i>
                Resend Verification Email
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <div class="d-grid">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-right"></i>
                Log Out
            </button>
        </div>
    </form>
</x-guest-layout>
