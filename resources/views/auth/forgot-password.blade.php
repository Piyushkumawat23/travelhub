@extends('auth.layout.app')

@section('content')
    <h3 class="mb-3">Forgot Password</h3>
    <p class="small text-muted">
        No problem. Just enter your email address and we’ll send you a reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
    </form>
@endsection
