@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Users')

@section('content')
    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <p class="text-muted mb-0">
                <i class="hicon hicon-mmb-account me-1"></i>
                Manage system users and roles
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            @if (auth()->user()->isRoot())
                <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-lg">
                    <i class="hicon hicon-add me-1"></i>
                    Add New User
                </a>
            @else
                <button class="btn btn-secondary btn-lg" disabled title="Only root admin can add users">
                    <i class="hicon hicon-lock me-1"></i>
                    Add New User (Root Only)
                </button>
            @endif
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Users</p>
                            <h3 class="mb-0">{{ $users->total() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-info-soft text-info">
                            <i class="hicon hicon-mmb-account"></i>
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
                            <p class="text-muted mb-1 small">Administrators</p>
                            <h3 class="mb-0">{{ $users->filter(fn($u) => $u->roles->contains('name', 'admin'))->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-danger-soft text-danger">
                            <i class="hicon hicon-shield"></i>
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
                            <p class="text-muted mb-1 small">Clients</p>
                            <h3 class="mb-0">{{ $users->filter(fn($u) => $u->roles->contains('name', 'client'))->count() }}</h3>
                        </div>
                        <div class="stat-icon-small bg-success-soft text-success">
                            <i class="hicon hicon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="hicon hicon-list me-1"></i>
                    All Users
                </h5>
                <span class="badge bg-info">{{ $users->total() }} {{ Str::plural('user', $users->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 70px;">Avatar</th>
                            <th style="width: 22%;">Name</th>
                            <th style="width: 25%;">Email</th>
                            <th style="width: 15%;" class="text-center">Roles</th>
                            <th style="width: 15%;">Joined</th>
                            <th style="width: 13%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                             alt="{{ $user->name }}" 
                                             class="rounded-circle" 
                                             style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                            style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong class="d-block">{{ $user->name }}</strong>
                                        <small class="text-muted">ID: #{{ $user->id }}</small>
                                    </div>
                                    @if ($user->id === auth()->id())
                                        <span class="badge bg-info-soft text-info mt-1">You</span>
                                    @endif
                                    @if ($user->isRoot())
                                        <span class="badge bg-danger mt-1">
                                            <i class="hicon hicon-shield me-1"></i>
                                            ROOT
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <i class="hicon hicon-email-envelope me-1 text-muted"></i>
                                    {{ $user->email }}
                                </td>
                                <td class="text-center">
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : 'success' }}-soft text-{{ $role->name === 'admin' ? 'danger' : 'success' }} px-3 py-2">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                    @if ($user->roles->isEmpty())
                                        <span class="badge bg-secondary-soft text-secondary px-3 py-2">No Role</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <i class="hicon hicon-calendar me-1 text-muted"></i>
                                        <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if (!$user->isRoot() || $user->id === auth()->id())
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="btn btn-outline-primary {{ auth()->user()->isRoot() && !$user->isRoot() && $user->id !== auth()->id() ? '' : 'rounded-pill' }}"
                                               title="Edit User"
                                               data-bs-toggle="tooltip">
                                                <i class="hicon hicon-edit"></i>
                                            </a>
                                            
                                            @if (auth()->user()->isRoot() && !$user->isRoot() && $user->id !== auth()->id())
                                                <button type="button"
                                                        class="btn btn-outline-danger rounded-end"
                                                        title="Delete User"
                                                        data-bs-toggle="tooltip"
                                                        onclick="if(confirm('Are you sure you want to delete {{ addslashes($user->name) }}?\n\nThis action cannot be undone.')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                                    <i class="hicon hicon-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                        
                                        @if (auth()->user()->isRoot() && !$user->isRoot() && $user->id !== auth()->id())
                                            <form id="delete-form-{{ $user->id }}" 
                                                  action="{{ route('admin.users.destroy', $user) }}" 
                                                  method="POST" 
                                                  class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    @else
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="hicon hicon-lock me-1"></i>
                                            Protected
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="hicon hicon-mmb-account mb-3"></i>
                                        <h4>No Users Yet</h4>
                                        <p class="text-muted mb-4">Start by adding your first user.</p>
                                        @if (auth()->user()->isRoot())
                                            <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-lg">
                                                <i class="hicon hicon-add me-1"></i>
                                                Create First User
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                    </div>
                    {{ $users->links() }}
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

    .empty-state i {
        font-size: 5rem;
        opacity: 0.3;
        color: #6c757d;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(13, 202, 240, 0.03);
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
