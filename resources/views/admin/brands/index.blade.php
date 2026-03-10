@extends('admin.layout.app')

@section('content')
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="mb-0">Brands</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3></h3>

            <a href="{{ route('admin.brands.create') }}" class="btn btn-success">
                Add Brand
            </a>
        </div>


        <div class="col-md-12">
            <div class="card mb-4">

                <div class="card-header">
                    <h3 class="card-title">Brand List</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $brand->name }}</td>

                                    <td>
                                        @if ($brand->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
                                            style="display:inline-block">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this brand?')">
                                                Delete
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center">No Brands Found</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
@endsection
