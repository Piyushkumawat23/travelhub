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
                {{-- पिछला पेज (Subscribers list) का लिंक यहाँ डालें --}}
                <li class="breadcrumb-item"><a href="{{ route('newsletter.index') }}">Subscribers</a></li> 
                <li class="breadcrumb-item active" aria-current="page">Send</li>
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

    {{-- Send Newsletter Form Card --}}
    <div class="col-md-12">
        <div class="card card-secondary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Compose Newsletter</div>
            </div>
            
            <form action="{{ route('admin.send.newsletter') }}" method="POST">
                @csrf
                <div class="card-body">
                    
                    {{-- Subject Field --}}
                    <div class="form-group mb-3">
                        <label for="subject" class="col-form-label">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Newsletter Subject" required>
                    </div>

                    {{-- Message Field --}}
                    <div class="form-group mb-3">
                        <label for="message" class="col-form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
                    </div>

                </div>

                {{-- Card Footer for Buttons --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Newsletter
                    </button>
                    {{-- Cancel Button (Go back to list) --}}
                    <a href="{{ route('newsletter.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection