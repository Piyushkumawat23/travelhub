@extends('auth.layout.app')

@section('content')
    <h4 class="mb-3">Verify Your Email</h4>

    <p class="text-muted">
        Thanks for signing up! Before getting started, please verify your email address 
        by clicking on the link we just emailed to you. 
        If you didn’t receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                Resend Verification Email
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger">
                Log Out
            </button>
        </form>
    </div>
@endsection
