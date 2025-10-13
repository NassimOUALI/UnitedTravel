@extends('layouts.admin')

@section('title', 'Create User')
@section('page-title', 'Create User')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.users._form')
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
