@extends('auth.layout.app')

@section('content')
    <h3 class="mb-4">Admin Login</h3>

    <form method="POST" action="{{ url('admin/login') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email') 
                <span class="text-danger small">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') 
                <span class="text-danger small">{{ $message }}</span> 
            @enderror
        </div>

        <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
@endsection
