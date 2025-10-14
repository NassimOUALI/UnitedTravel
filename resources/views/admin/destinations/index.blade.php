@extends('layouts.admin')

@section('title', 'Manage Destinations')
@section('page-title', 'Destinations')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-flights-pin me-1"></i>
                Manage travel destinations and locations
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary btn-lg">
                <i class="hicon hicon-add me-1"></i>
                Add New Destination
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Destinations</p>
                            <h3 class="mb-0">{{ $destinations->total() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-primary-soft text-primary">
                            <i class="hicon hicon-flights-pin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">With Tours</p>
                            <h3 class="mb-0">{{ $destinations->filter(fn($d) => $d->tours->count() > 0)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-menu-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Added This Month</p>
                            <h3 class="mb-0">{{ $destinations->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Destinations Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    All Destinations
                </h5>
                <span class="badge bg-primary">{{ $destinations->total() }} {{ Str::plural('destination', $destinations->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Image</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 20%;">Location</th>
                            <th style="width: 30%;">Description</th>
                            <th class="text-center" style="width: 10%;">Tours</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $destination)
                        <tr>
                            <td class="ps-4">
                                @php
                                    // Get primary image or first image
                                    $thumbnailImage = null;
                                    if ($destination->relationLoaded('images') && $destination->images->count() > 0) {
                                        $primaryImage = $destination->images->where('is_primary', true)->first();
                                        $thumbnailImage = $primaryImage ? $primaryImage->path : $destination->images->first()->path;
                                    } elseif ($destination->image_path) {
                                        $thumbnailImage = $destination->image_path;
                                    }
                                @endphp
                                @if($thumbnailImage)
                                    <img src="{{ asset('public/' . $thumbnailImage) }}" 
                                         alt="{{ $destination->name }}" 
                                         class="rounded-3 shadow-sm" 
                                         style="width: 65px; height: 65px; object-fit: cover;">
                                @else
                                    <div class="destination-placeholder rounded-3">
                                        <i class="hicon hicon-flights-pin"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong class="d-block">{{ $destination->name }}</strong>
                                <small class="text-muted">ID: #{{ $destination->id }}</small>
                            </td>
                            <td>
                                <i class="hicon hicon-location me-1 text-primary"></i>
                                {{ $destination->location }}
                            </td>
                            <td>
                                <p class="mb-0 small text-muted">
                                    {{ Str::limit($destination->description, 80) }}
                                </p>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-soft text-primary px-3 py-2">
                                    {{ $destination->tours->count() }} {{ Str::plural('tour', $destination->tours->count()) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('destinations.show', $destination) }}" 
                                       class="btn btn-outline-info rounded-start"
                                       title="View Public Page"
                                       target="_blank"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $destination) }}" 
                                       class="btn btn-outline-primary"
                                       title="Edit Destination"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-end"
                                            title="Delete Destination"
                                            data-bs-toggle="tooltip"
                                            onclick="if(confirm('Are you sure you want to delete {{ addslashes($destination->name) }}?\n\nThis will affect {{ $destination->tours->count() }} associated {{ Str::plural('tour', $destination->tours->count()) }}.\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $destination->id }}').submit(); }">
                                        <i class="hicon hicon-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $destination->id }}" 
                                      action="{{ route('admin.destinations.destroy', $destination) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="hicon hicon-flights-pin mb-3"></i>
                                    <h4>No Destinations Yet</h4>
                                    <p class="text-muted mb-4">Start by adding your first travel destination.</p>
                                    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary btn-lg">
                                        <i class="hicon hicon-add me-1"></i>
                                        Add First Destination
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if ($destinations->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $destinations->firstItem() }} to {{ $destinations->lastItem() }} of {{ $destinations->total() }} results
                    </div>
                    {{ $destinations->links() }}
                </div>
            </div>
        @endif
    </div>

@endsection

@push('styles')
<style>
    .stat-icon-small {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .destination-placeholder {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.2) 100%);
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .empty-state i {
        font-size: 5rem;
        opacity: 0.3;
        color: #6c757d;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
        transform: scale(1.005);
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
