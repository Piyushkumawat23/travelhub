@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    {{-- Page Header and Breadcrumb --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Newsletter</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                {{-- लिस्ट पेज का लिंक --}}
                <li class="breadcrumb-item"><a href="{{ route('newsletter.index') }}">Subscribers</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Subscriber</li>
            </ol>
        </div>
    </div>

    {{-- Flash Message Section --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Edit Subscriber Form Card --}}
    <div class="col-md-6">
        <div class="card card-secondary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit Subscriber</div>
            </div>
            
            <form action="{{ route('newsletter.update', $subscriber->id) }}" method="POST">
                @csrf
                {{-- Update के लिए PUT मेथड ज़रूरी होता है --}}
                @method('PUT') 
                
                <div class="card-body">
                    
                    {{-- Email Field --}}
                    <div class="form-group mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $subscriber->email }}" required>
                    </div>

                    {{-- Status Dropdown --}}
                    <div class="form-group mb-3">
                        <label for="status" class="col-form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="subscribed" {{ $subscriber->status == 'subscribed' ? 'selected' : '' }}>Subscribed</option>
                            <option value="unsubscribed" {{ $subscriber->status == 'unsubscribed' ? 'selected' : '' }}>Unsubscribed</option>
                        </select>
                    </div>

                </div>

                {{-- Card Footer for Buttons --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    {{-- Cancel Button --}}
                    <a href="{{ route('newsletter.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection