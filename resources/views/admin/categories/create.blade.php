@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    {{-- Page Header and Breadcrumb --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Categories</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                {{-- Index Route पर जाने के लिए --}}
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
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

    {{-- Create Category Form Card (Using Staff's Card Layout) --}}
    <div class="col-md-6">
        <div class="card card-secondary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Add Category</div>
            </div>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    
                    {{-- Name Field --}}
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label">Name</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Category Name" required />
                    </div>

                    {{-- Description Field --}}
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description"></textarea>
                    </div>

                </div>

                {{-- Card Footer for Button --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    {{-- Cancel button logic --}}
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection