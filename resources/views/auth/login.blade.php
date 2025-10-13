@extends('layouts.app')

@section('title', 'Login - United Travels')

@section('content')

<!-- Login -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-5 col-lg-8 col-md-9">
                <div class="card border-0 shadow-sm p-xl-2">
                    <div class="card-body">
                        <div class="border-bottom mb-4">
                            <h1 class="h2 text-body-emphasis">Login</h1>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Login Form -->
                            <div class="pb-4">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input class="form-control shadow-sm @error('email') is-invalid @enderror" 
                                           type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input class="form-control shadow-sm @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           type="password" 
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input shadow-sm" 
                                                       type="checkbox" 
                                                       id="remember" 
                                                       name="remember"
                                                       {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    <span class="text-body">Remember me</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-4 text-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <i class="hicon hicon-aps-lock"></i>
                                        <span>Login</span>
                                    </button>
                                </div>
                            </div>
                            <!-- /Login Form -->
                            
                            <div class="mt-4">
                                <span>Don't have an account? <a href="{{ route('register') }}">Register</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Login -->

@endsection

