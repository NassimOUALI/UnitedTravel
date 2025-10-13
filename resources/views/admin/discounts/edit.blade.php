@extends('layouts.admin')

@section('title', 'Edit Discount')
@section('page-title', 'Edit Discount')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.discounts._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="hicon hicon-save me-1"></i>
                            Update Discount
                        </button>
                        <a href="{{ route('admin.discounts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
