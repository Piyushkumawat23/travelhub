@extends('user.layout.app')

@section('content')
    <h2>Welcome, User!</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
@endsection
