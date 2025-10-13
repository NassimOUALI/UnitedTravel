@extends('layouts.admin')

@section('title', 'Manage Discounts')
@section('page-title', 'Discounts')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-discount me-1"></i>
                Manage promotional discounts and offers
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.discounts.create') }}" class="btn btn-danger btn-lg">
                <i class="hicon hicon-add me-1"></i>
                Add New Discount
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
                            <p class="text-muted mb-1 small">Total Discounts</p>
                            <h3 class="mb-0">{{ $discounts->total() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-danger-soft text-danger">
                            <i class="hicon hicon-discount"></i>
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
                            <p class="text-muted mb-1 small">Active Discounts</p>
                            <h3 class="mb-0">{{ $discounts->filter(fn($d) => $d->valid_until->isFuture())->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-confirmation-instant"></i>
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
                            <p class="text-muted mb-1 small">In Use</p>
                            <h3 class="mb-0">{{ $discounts->filter(fn($d) => $d->tours_count > 0)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-backpack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Discounts Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    All Discounts
                </h5>
                <span class="badge bg-danger">{{ $discounts->total() }} {{ Str::plural('discount', $discounts->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 30%;">Discount Name</th>
                            <th style="width: 15%;" class="text-center">Percentage</th>
                            <th style="width: 15%;">Valid Until</th>
                            <th style="width: 12%;" class="text-center">Tours</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 13%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($discounts as $discount)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="discount-icon me-3">
                                        <i class="hicon hicon-discount"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block">{{ $discount->name }}</strong>
                                        <small class="text-muted">ID: #{{ $discount->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-danger fs-6 px-3 py-2">{{ $discount->percentage }}% OFF</span>
                            </td>
                            <td>
                                <div>
                                    <i class="hicon hicon-calendar me-1 text-muted"></i>
                                    <strong>{{ $discount->valid_until->format('M d, Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $discount->valid_until->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info-soft text-info px-3 py-2">
                                    {{ $discount->tours_count }} {{ Str::plural('tour', $discount->tours_count) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($discount->valid_until->isFuture())
                                    <span class="badge bg-success-soft text-success px-3 py-2">
                                        <i class="hicon hicon-confirmation-instant me-1"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary-soft text-secondary px-3 py-2">
                                        <i class="hicon hicon-close-popup me-1"></i>
                                        Expired
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.discounts.edit', $discount) }}" 
                                       class="btn btn-outline-primary rounded-start"
                                       title="Edit Discount"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-end"
                                            title="Delete Discount"
                                            data-bs-toggle="tooltip"
                                            onclick="if(confirm('{{ $discount->tours_count > 0 ? "This discount is used by " . $discount->tours_count . " tour(s). Are you sure you want to delete it?" : "Are you sure you want to delete this discount?" }}\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $discount->id }}').submit(); }">
                                        <i class="hicon hicon-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $discount->id }}" 
                                      action="{{ route('admin.discounts.destroy', $discount) }}" 
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
                                    <i class="hicon hicon-discount mb-3"></i>
                                    <h4>No Discounts Yet</h4>
                                    <p class="text-muted mb-4">Start by creating your first promotional discount.</p>
                                    <a href="{{ route('admin.discounts.create') }}" class="btn btn-danger btn-lg">
                                        <i class="hicon hicon-add me-1"></i>
                                        Create First Discount
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
        @if ($discounts->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $discounts->firstItem() }} to {{ $discounts->lastItem() }} of {{ $discounts->total() }} results
                    </div>
                    {{ $discounts->links() }}
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

    .discount-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.2) 100%);
        color: #dc3545;
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
        background-color: rgba(220, 53, 69, 0.03);
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
