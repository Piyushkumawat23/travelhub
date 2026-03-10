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
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

    {{-- Edit Category Form Card --}}
    <div class="col-md-6">
        <div class="card card-secondary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit Category: {{ $category->name }}</div>
            </div>
            
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    
                    {{-- Name Field --}}
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
                    </div>

                    {{-- Description Field --}}
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                    </div>

                    {{-- Status Dropdown --}}
                    <div class="form-group mb-3">
                        <label for="status" class="col-form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                {{-- Card Footer for Buttons --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection