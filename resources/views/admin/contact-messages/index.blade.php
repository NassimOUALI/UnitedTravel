@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-email-envelope me-1"></i>
                Manage contact form submissions and inquiries
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <form action="{{ route('admin.contact-messages.index') }}" method="GET" class="d-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search messages..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="hicon hicon-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Messages</p>
                            <h3 class="mb-0">{{ $stats['total'] }}</h3>
                        </div>
                        <div class="stat-icon-small bg-primary-soft text-primary">
                            <i class="hicon hicon-email-envelope"></i>
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
                            <p class="text-muted mb-1 small">New</p>
                            <h3 class="mb-0">{{ $stats['new'] }}</h3>
                        </div>
                        <div class="stat-icon-small bg-warning-soft text-warning">
                            <i class="hicon hicon-information"></i>
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
                            <p class="text-muted mb-1 small">Read</p>
                            <h3 class="mb-0">{{ $stats['read'] }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-eye"></i>
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
                            <p class="text-muted mb-1 small">Replied</p>
                            <h3 class="mb-0">{{ $stats['replied'] }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-confirmation-instant"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.contact-messages.index') }}">
                        All Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'new' ? 'active' : '' }}" href="{{ route('admin.contact-messages.index', ['status' => 'new']) }}">
                        New
                        @if($stats['new'] > 0)
                            <span class="badge bg-warning text-dark ms-1">{{ $stats['new'] }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'read' ? 'active' : '' }}" href="{{ route('admin.contact-messages.index', ['status' => 'read']) }}">
                        Read
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'replied' ? 'active' : '' }}" href="{{ route('admin.contact-messages.index', ['status' => 'replied']) }}">
                        Replied
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'archived' ? 'active' : '' }}" href="{{ route('admin.contact-messages.index', ['status' => 'archived']) }}">
                        Archived
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    Messages
                </h5>
                <span class="badge bg-primary">{{ $messages->total() }} {{ Str::plural('message', $messages->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%;"><i class="hicon hicon-info"></i></th>
                            <th style="width: 20%;">From</th>
                            <th style="width: 25%;">Subject</th>
                            <th style="width: 25%;">Message</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 10%;">Date</th>
                            <th style="width: 10%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr class="{{ $message->isNew() ? 'table-warning' : '' }}">
                            <td class="ps-4">
                                @if($message->isNew())
                                    <span class="text-warning" title="New message">
                                        <i class="hicon hicon-information fs-5"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong class="d-block">{{ $message->name }}</strong>
                                    <small class="text-muted d-block">
                                        <i class="hicon hicon-email-envelope me-1"></i>
                                        {{ $message->email }}
                                    </small>
                                    @if($message->phone)
                                        <small class="text-muted d-block">
                                            <i class="hicon hicon-phone me-1"></i>
                                            {{ $message->phone }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <strong>{{ $message->subject }}</strong>
                            </td>
                            <td>
                                <p class="mb-0 small text-muted">
                                    {{ Str::limit($message->message, 80) }}
                                </p>
                            </td>
                            <td class="text-center">
                                @if($message->status === 'new')
                                    <span class="badge bg-warning-soft text-warning px-3 py-2">New</span>
                                @elseif($message->status === 'read')
                                    <span class="badge bg-info-soft text-info px-3 py-2">Read</span>
                                @elseif($message->status === 'replied')
                                    <span class="badge bg-success-soft text-success px-3 py-2">Replied</span>
                                @elseif($message->status === 'archived')
                                    <span class="badge bg-secondary-soft text-secondary px-3 py-2">Archived</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $message->created_at->format('M d, Y') }}
                                    <br>
                                    {{ $message->created_at->format('g:i A') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                       class="btn btn-outline-primary rounded-start"
                                       title="View Message"
                                       data-bs-toggle="tooltip">
                                        <i class="hicon hicon-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger rounded-end"
                                            title="Delete Message"
                                            data-bs-toggle="tooltip"
                                            onclick="if(confirm('Are you sure you want to delete this message from {{ addslashes($message->name) }}?\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $message->id }}').submit(); }">
                                        <i class="hicon hicon-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $message->id }}" 
                                      action="{{ route('admin.contact-messages.destroy', $message) }}" 
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
                                    <i class="hicon hicon-email-envelope mb-3"></i>
                                    <h4>No Messages Found</h4>
                                    <p class="text-muted mb-0">
                                        @if(request('search'))
                                            No messages match your search criteria.
                                        @elseif(request('status'))
                                            No {{ request('status') }} messages.
                                        @else
                                            No contact messages received yet.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if ($messages->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                    </div>
                    {{ $messages->links() }}
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

    .empty-state i {
        font-size: 5rem;
        opacity: 0.3;
        color: #6c757d;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover:not(.table-warning) {
        background-color: rgba(13, 110, 253, 0.03);
    }

    .table-warning:hover {
        background-color: rgba(255, 193, 7, 0.15) !important;
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

