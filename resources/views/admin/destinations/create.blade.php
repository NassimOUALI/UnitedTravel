@extends('layouts.admin')

@section('title', 'Create Destination')
@section('page-title', 'Create New Destination')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.destinations.index') }}">Destinations</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="mb-0">
                    <i class="hicon hicon-add me-2"></i>
                    Create New Destination
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.destinations._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
