@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    {{-- Page Header and Breadcrumb --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Newsletter Subscribers</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Newsletter</li>
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

    {{-- Quick Subscribe Form Card --}}
    <div class="col-md-12 mb-4">
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title">Add New Subscriber</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('newsletter.store') }}" method="POST" class="row g-3 align-items-center">
                    @csrf
                    <div class="col-md-10">
                        <label class="visually-hidden" for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Subscribers List Card --}}
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Subscribers List</h3>
                {{-- Send Newsletter Button in Header --}}
                <a href="{{ route('newsletter.show') }}" class="btn btn-success btn-sm ml-auto">
                    <i class="fas fa-paper-plane"></i> Send Newsletter
                </a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscribers as $subscriber)
                        <tr class="align-middle">
                            <!-- <td>{{ $subscriber->id }}</td> -->
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td>
                                {{-- Status Badge Styling --}}
                                @if(strtolower($subscriber->status) == 'active' || strtolower($subscriber->status) == 'subscribed')
                                    <span class="badge bg-success">{{ ucfirst($subscriber->status) }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($subscriber->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('newsletter.edit', $subscriber->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                
                                <a href="{{ route('newsletter.delete', $subscriber->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subscriber?')">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No Subscribers Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection