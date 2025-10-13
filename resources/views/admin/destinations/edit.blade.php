@extends('layouts.admin')

@section('title', 'Edit Destination')
@section('page-title', 'Edit Destination')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.destinations.index') }}">Destinations</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit: {{ Str::limit($destination->name, 30) }}</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="hicon hicon-edit me-2"></i>
                        Edit Destination
                    </h5>
                    <span class="badge bg-white text-dark">ID: #{{ $destination->id }}</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.destinations._form')
                </form>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="card border-danger mt-4">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0">
                    <i class="hicon hicon-warning me-1"></i>
                    Danger Zone
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Delete This Destination</strong>
                        <p class="text-muted small mb-0">
                            This will affect {{ $destination->tours->count() }} associated {{ Str::plural('tour', $destination->tours->count()) }}. 
                            Once deleted, this cannot be recovered.
                        </p>
                    </div>
                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger rounded-pill"
                                onclick="return confirm('Are you sure you want to delete {{ addslashes($destination->name) }}?\n\nThis will affect {{ $destination->tours->count() }} tours.\n\nThis action cannot be undone.')">
                            <i class="hicon hicon-trash me-1"></i>
                            Delete Destination
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
