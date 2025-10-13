@extends('layouts.admin')

@section('title', 'Edit Tour')
@section('page-title', 'Edit Tour')

@section('content')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.tours.update', $tour) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.tours._form')
                    
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="hicon hicon-save me-1"></i>
                            Update Tour
                        </button>
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="hicon hicon-information me-1"></i>
                    Information
                </h5>
                <p class="small mb-2">
                    <strong>Created:</strong> {{ $tour->created_at->format('M d, Y') }}
                </p>
                <p class="small mb-2">
                    <strong>Last Updated:</strong> {{ $tour->updated_at->diffForHumans() }}
                </p>
                <p class="small mb-2">
                    <strong>Destinations:</strong> {{ $tour->destinations->count() }}
                </p>
                @if($tour->discount)
                    <p class="small mb-0">
                        <strong>Discount:</strong> {{ $tour->discount->name }} ({{ $tour->discount->percentage }}%)
                    </p>
                @endif
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="hicon hicon-question me-1"></i>
                    Tips
                </h5>
                <ul class="small mb-0">
                    <li class="mb-2">Update tour details regularly to keep information current</li>
                    <li class="mb-2">Adjust pricing seasonally if needed</li>
                    <li class="mb-0">Changes will reflect immediately on the website</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
