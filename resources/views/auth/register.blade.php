@extends('layouts.app')

@section('title', 'Register - United Travels')

@section('content')

<!-- Register -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-5 col-lg-8 col-md-9">
                <div class="card border-0 shadow-sm p-xl-2">
                    <div class="card-body">
                        <div class="border-bottom mb-4">
                            <h1 class="h2 text-body-emphasis">Register</h1>
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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <!-- Register Form -->
                            <div class="pb-4">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name<span class="text-danger">*</span></label>
                                    <input class="form-control shadow-sm @error('name') is-invalid @enderror" 
                                           type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input class="form-control shadow-sm @error('email') is-invalid @enderror" 
                                           type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required>
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
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input class="form-control shadow-sm" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           type="password" 
                                           required>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-sm @error('terms') is-invalid @enderror" 
                                               type="checkbox" 
                                               id="terms" 
                                               name="terms" 
                                               required>
                                        <label class="form-check-label" for="terms">
                                            <span class="text-body">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <button class="btn btn-primary w-100" type="submit" id="register-submit">
                                        <i class="hicon hicon-edit"></i>
                                        <span>Register</span>
                                    </button>
                                </div>
                            </div>
                            <!-- /Register Form -->
                            
                            <div class="mt-4">
                                <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
                            </div>
                        </form>
                        
                        @if(config('recaptcha.enabled'))
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                This site is protected by reCAPTCHA and the Google
                                <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and
                                <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Register -->

@endsection

@if(config('recaptcha.enabled') && config('recaptcha.site_key'))
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="{{ route('register') }}"]');
        const submitButton = document.getElementById('register-submit');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable submit button to prevent double submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Verifying...';
            
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'register'}).then(function(token) {
                    // Add the token to the form
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'g-recaptcha-response';
                    input.value = token;
                    form.appendChild(input);
                    
                    // Submit the form
                    form.submit();
                }).catch(function(error) {
                    console.error('reCAPTCHA error:', error);
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="hicon hicon-edit"></i><span>Register</span>';
                    alert('Security verification failed. Please refresh the page and try again.');
                });
            });
        });
    });
</script>
@endpush
@endif

