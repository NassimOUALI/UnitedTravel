@extends('layouts.admin')

@section('title', 'Manage Tours')
@section('page-title', 'Tours')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-backpack me-1"></i>
                Manage tour packages and itineraries
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-success btn-lg">
                <i class="hicon hicon-add me-1"></i>
                Add New Tour
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Tours</p>
                            <h3 class="mb-0">{{ $tours->total() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-backpack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">With Discounts</p>
                            <h3 class="mb-0">{{ $tours->filter(fn($t) => $t->discount)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-danger-soft text-danger">
                            <i class="hicon hicon-discount"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Priced</p>
                            <h3 class="mb-0">{{ $tours->filter(fn($t) => $t->is_price_defined && $t->price)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-warning-soft text-warning">
                            <i class="hicon hicon-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">This Month</p>
                            <h3 class="mb-0">{{ $tours->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tours Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    All Tours
                </h5>
                <span class="badge bg-success">{{ $tours->total() }} {{ Str::plural('tour', $tours->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Image</th>
                            <th style="width: 25%;">Title</th>
                            <th style="width: 15%;">Destinations</th>
                            <th style="width: 12%;">Duration</th>
                            <th style="width: 12%;">Price</th>
                            <th style="width: 10%;" class="text-center">Discount</th>
                            <th style="width: 13%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tours as $tour)
                        <tr>
                            <td class="ps-4">
                                @php
                                    // Get primary image or first image
                                    $thumbnailImage = null;
                                    if ($tour->relationLoaded('images') && $tour->images->count() > 0) {
                                        $primaryImage = $tour->images->where('is_primary', true)->first();
                                        $thumbnailImage = $primaryImage ? $primaryImage->path : $tour->images->first()->path;
                                    } elseif ($tour->image_path) {
                                        $thumbnailImage = $tour->image_path;
                                    }
                                @endphp
                                @if($thumbnailImage)
                                    <img src="{{ asset($thumbnailImage) }}" 
                                         alt="{{ $tour->title }}" 
                                         class="rounded-3 shadow-sm" 
                                         style="width: 65px; height: 65px; object-fit: cover;">
                                @else
                                    <div class="tour-placeholder rounded-3">
                                        <i class="hicon hicon-backpack"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong class="d-block">{{ $tour->title }}</strong>
                                <small class="text-muted">ID: #{{ $tour->id }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info-soft text-info px-2 py-1">
                                    <i class="hicon hicon-location me-1"></i>
                                    {{ $tour->destinations->count() }}
                                </span>
                            </td>
                            <td>
                                <i class="hicon hicon-time-clock me-1 text-muted"></i>
                                {{ $tour->duration ?? 'N/A' }}
                            </td>
                            <td>
                                @if($tour->is_price_defined && $tour->price)
                                    <strong class="text-success">{{ format_price($tour->price, 0) }}</strong>
                                @else
                                    <span class="text-muted small">On request</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($tour->discount)
                                    <span class="badge bg-danger px-3 py-2">{{ $tour->discount->percentage }}% OFF</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('tours.show', $tour) }}" 
                                       class="btn btn-outline-info rounded-start"
                                       title="View Public Page"
                                       target="_blank"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.tours.edit', $tour) }}" 
                                       class="btn btn-outline-primary"
                                       title="Edit Tour"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-end"
                                            title="Delete Tour"
                                            data-bs-toggle="tooltip"
                                            onclick="if(confirm('Are you sure you want to delete {{ addslashes($tour->title) }}?\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $tour->id }}').submit(); }">
                                        <i class="hicon hicon-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $tour->id }}" 
                                      action="{{ route('admin.tours.destroy', $tour) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="hicon hicon-backpack mb-3"></i>
                                    <h4>No Tours Yet</h4>
                                    <p class="text-muted mb-4">Start by adding your first tour package.</p>
                                    <a href="{{ route('admin.tours.create') }}" class="btn btn-success btn-lg">
                                        <i class="hicon hicon-add me-1"></i>
                                        Add First Tour
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
        @if ($tours->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $tours->firstItem() }} to {{ $tours->lastItem() }} of {{ $tours->total() }} results
                    </div>
                    {{ $tours->links() }}
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

    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }

    .tour-placeholder {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.2) 100%);
        color: #198754;
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
        background-color: rgba(25, 135, 84, 0.03);
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
