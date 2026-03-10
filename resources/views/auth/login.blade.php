@extends('auth.layout.app')

@section('content')
    <h3 class="mb-4">Login</h3>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input id="password" class="form-control" type="password" name="password" required>
            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
            <label class="form-check-label" for="remember_me">Remember Me</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
            @endif
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection
