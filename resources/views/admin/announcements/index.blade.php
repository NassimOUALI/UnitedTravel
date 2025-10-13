@extends('layouts.admin')

@section('title', 'Manage Announcements')
@section('page-title', 'Announcements')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-megaphone me-1"></i>
                Manage system-wide announcements and news updates
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary btn-lg">
                <i class="hicon hicon-add me-1"></i>
                Add New Announcement
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total</p>
                            <h3 class="mb-0">{{ $announcements->total() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-primary-soft text-primary">
                            <i class="hicon hicon-megaphone"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Visible</p>
                            <h3 class="mb-0">{{ $announcements->where('visible', true)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-confirmation-instant"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Hidden</p>
                            <h3 class="mb-0">{{ $announcements->where('visible', false)->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-secondary-soft text-secondary">
                            <i class="hicon hicon-close-popup"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">This Month</p>
                            <h3 class="mb-0">{{ $announcements->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    All Announcements
                </h5>
                <span class="badge bg-primary">{{ $announcements->total() }} {{ Str::plural('announcement', $announcements->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 30%;">Title</th>
                            <th style="width: 35%;">Content</th>
                            <th style="width: 10%;" class="text-center">Visibility</th>
                            <th style="width: 15%;">Created</th>
                            <th style="width: 10%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $announcement)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="announcement-icon me-3">
                                            <i class="hicon hicon-megaphone"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block">{{ $announcement->title }}</strong>
                                            <small class="text-muted">ID: #{{ $announcement->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 small text-muted">
                                        {{ Str::limit($announcement->content, 100) }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if ($announcement->visible)
                                        <span class="badge bg-success-soft text-success px-3 py-2">
                                            <i class="hicon hicon-confirmation-instant me-1"></i>
                                            Visible
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-soft text-secondary px-3 py-2">
                                            <i class="hicon hicon-close-popup me-1"></i>
                                            Hidden
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <small class="text-muted d-block">
                                            <i class="hicon hicon-calendar me-1"></i>
                                            {{ $announcement->created_at->format('M d, Y') }}
                                        </small>
                                        <small class="text-muted">
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                            class="btn btn-outline-primary rounded-start" 
                                            title="Edit Announcement"
                                            data-bs-toggle="tooltip">
                                            <i class="hicon hicon-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger rounded-end" 
                                                title="Delete Announcement"
                                                data-bs-toggle="tooltip"
                                                onclick="if(confirm('Are you sure you want to delete this announcement?\n\nTitle: {{ addslashes($announcement->title) }}\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $announcement->id }}').submit(); }">
                                            <i class="hicon hicon-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $announcement->id }}" 
                                          action="{{ route('admin.announcements.destroy', $announcement) }}" 
                                          method="POST" 
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="hicon hicon-megaphone mb-3"></i>
                                        <h4>No Announcements Yet</h4>
                                        <p class="text-muted mb-4">Start by creating your first announcement to keep your users informed.</p>
                                        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary btn-lg">
                                            <i class="hicon hicon-add me-1"></i>
                                            Create First Announcement
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
        @if ($announcements->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $announcements->firstItem() }} to {{ $announcements->lastItem() }} of {{ $announcements->total() }} results
                    </div>
                    {{ $announcements->links() }}
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

    .announcement-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%);
        color: #ffc107;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
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
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
