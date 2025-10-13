@extends('layouts.admin')

@section('title', 'Create Tour')
@section('page-title', 'Create Tour')

@section('content')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.tours._form')
                    
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="hicon hicon-save me-1"></i>
                            Create Tour
                        </button>
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Help Sidebar -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="hicon hicon-question me-1"></i>
                    Tips
                </h5>
                <ul class="small mb-0">
                    <li class="mb-2">Create a compelling title that highlights the tour's uniqueness</li>
                    <li class="mb-2">Select multiple destinations to create multi-city tours</li>
                    <li class="mb-2">Set clear pricing or mark as "Price on request"</li>
                    <li class="mb-2">Upload an eye-catching image (recommended: 1200x800px)</li>
                    <li class="mb-0">Apply discounts to promote special offers</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
