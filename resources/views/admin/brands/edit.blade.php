@extends('admin.layout.app')

@section('content')

<div class="container-fluid">


{{-- Page Header and Breadcrumb --}}
<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Brands</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>

{{-- Flash Message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Edit Brand Form --}}
<div class="col-md-6">
    <div class="card card-secondary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Edit Brand: {{ $brand->name }}</div>
        </div>

        <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group mb-3">
                    <label class="col-form-label">Brand Name</label>
                    <input type="text" name="name" value="{{ $brand->name }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label class="col-form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $brand->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="col-form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Brand</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Cancel</a>
            </div>

        </form>

    </div>
</div>


</div>
@endsection
