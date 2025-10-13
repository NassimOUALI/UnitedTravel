@extends('layouts.admin')

@section('title', 'Edit Announcement')
@section('page-title', 'Edit Announcement')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}">Announcements</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit: {{ Str::limit($announcement->title, 30) }}</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="hicon hicon-edit me-2"></i>
                        Edit Announcement
                    </h5>
                    <span class="badge bg-white text-dark">ID: #{{ $announcement->id }}</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.announcements._form')
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
                        <strong>Delete This Announcement</strong>
                        <p class="text-muted small mb-0">Once deleted, this announcement cannot be recovered.</p>
                    </div>
                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this announcement?\n\nTitle: {{ addslashes($announcement->title) }}\n\nThis action cannot be undone.')">
                            <i class="hicon hicon-trash me-1"></i>
                            Delete Announcement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
