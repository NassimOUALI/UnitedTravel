@extends('layouts.app')

@section('title', 'My Profile - United Travels')

@section('content')

<!-- Page Title -->
<section class="hero hero-sm" data-aos="fade">
    <div class="hero-bg">
        <img src="{{ asset('assets/img/background/b4.jpg') }}" {{-- srcset="{{ asset('assets/img/background/b4@2x.jpg') }} 2x" --}} alt="Profile">
    </div>
    <div class="bg-content container">
        <div class="hero-page-title">
            <span class="hero-sub-title">Account Settings</span>
            <h1 class="display-3 hero-title">My Profile</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
</section>
<!-- /Page Title -->

<!-- Profile Content -->
<section class="p-top-90 p-bottom-90 bg-gray-gradient" data-aos="fade">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <!-- Profile Photo -->
                        <div class="mb-3">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     alt="{{ $user->name }}" 
                                     class="rounded-circle mb-3" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                                     style="width: 120px; height: 120px; font-size: 3rem; font-weight: 600;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- User Info -->
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small mb-2">{{ $user->email }}</p>
                        
                        <!-- Roles -->
                        <div class="mb-3">
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </div>
                        
                        <!-- Stats -->
                        <div class="border-top pt-3">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="fw-bold text-primary">0</div>
                                    <small class="text-muted">Bookings</small>
                                </div>
                                <div class="col-6">
                                    <div class="fw-bold text-primary">{{ $user->created_at->diffForHumans() }}</div>
                                    <small class="text-muted">Joined</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Quick Links</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">
                                <i class="hicon hicon-dashboard me-1"></i>
                                Dashboard
                            </a>
                            @if($user->roles->contains('name', 'admin'))
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-success">
                                    <i class="hicon hicon-settings me-1"></i>
                                    Admin Panel
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="hicon hicon-confirmation-instant me-2"></i>
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- General Error Message -->
                @if($errors->has('general'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="hicon hicon-warning me-2"></i>
                        <strong>Error!</strong> {{ $errors->first('general') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Validation Errors Summary -->
                @if($errors->any() && !$errors->has('general'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="hicon hicon-warning me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                            <i class="hicon hicon-mmb-account me-1"></i>
                            Profile Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                            <i class="hicon hicon-lock me-1"></i>
                            Change Password
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photo" type="button" role="tab">
                            <i class="hicon hicon-camera me-1"></i>
                            Profile Photo
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="profileTabContent">
                    <!-- Profile Information Tab -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Update Profile Information</h5>
                                <small class="text-muted">Update your account's profile information and email address.</small>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email Address <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">We'll never share your email with anyone else.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Member Since</label>
                                        <input type="text" class="form-control" value="{{ $user->created_at->format('F d, Y') }}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Account Roles</label>
                                        <div>
                                            @foreach($user->roles as $role)
                                                <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="hicon hicon-save me-1"></i>
                                            Save Changes
                                        </button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Tab -->
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Change Password</h5>
                                <small class="text-muted">Ensure your account is using a long, random password to stay secure.</small>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Hidden fields to pass validation -->
                                    <input type="hidden" name="name" value="{{ $user->name }}">
                                    <input type="hidden" name="email" value="{{ $user->email }}">

                                    <div class="alert alert-info">
                                        <i class="hicon hicon-information me-2"></i>
                                        <strong>Password Requirements:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>Minimum 8 characters</li>
                                            <li>At least one uppercase letter</li>
                                            <li>At least one lowercase letter</li>
                                            <li>At least one number</li>
                                        </ul>
                                    </div>

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">
                                            Current Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">
                                            New Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" 
                                               name="new_password">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">
                                            Confirm New Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="hicon hicon-lock me-1"></i>
                                            Update Password
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary">Clear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Photo Tab -->
                    <div class="tab-pane fade" id="photo" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">Profile Photo</h5>
                                <small class="text-muted">Upload a profile photo or use your initials.</small>
                            </div>
                            <div class="card-body">
                                <!-- Current Photo -->
                                <div class="text-center mb-4">
                                    <div class="mb-3" id="photoPreviewContainer">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                                 alt="{{ $user->name }}" 
                                                 class="rounded-circle shadow" 
                                                 style="width: 150px; height: 150px; object-fit: cover;"
                                                 id="photoPreview">
                                        @else
                                            <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center shadow" 
                                                 style="width: 150px; height: 150px; font-size: 4rem; font-weight: 600;"
                                                 id="photoPreview">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-1">
                                        <i class="hicon hicon-information me-1"></i>
                                        JPG, PNG, GIF, or JPEG accepted
                                    </p>
                                    <p class="text-muted small">Maximum file size: 2MB</p>
                                </div>

                                <!-- Upload Form -->
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="photoUploadForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Hidden fields to pass validation -->
                                    <input type="hidden" name="name" value="{{ $user->name }}">
                                    <input type="hidden" name="email" value="{{ $user->email }}">

                                    <div class="mb-4">
                                        <label for="profile_photo" class="form-label fw-bold">
                                            <i class="hicon hicon-camera me-1"></i>
                                            Choose New Photo
                                        </label>
                                        <input type="file" 
                                               class="form-control @error('profile_photo') is-invalid @enderror" 
                                               id="profile_photo" 
                                               name="profile_photo"
                                               accept="image/jpeg,image/png,image/jpg,image/gif"
                                               onchange="previewImage(event)">
                                        @error('profile_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <span id="fileInfo" class="text-muted"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-stretch align-items-sm-center">
                                        <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>
                                            <i class="hicon hicon-upload me-1"></i>
                                            Upload Photo
                                        </button>
                                        
                                        @if($user->profile_photo)
                                        <form action="{{ route('profile.update') }}" method="POST" class="d-inline" id="removePhotoForm">
                                            @csrf
                                            @method('PUT')
                                            <!-- Hidden fields to pass validation -->
                                            <input type="hidden" name="name" value="{{ $user->name }}">
                                            <input type="hidden" name="email" value="{{ $user->email }}">
                                            <button type="submit" 
                                                    name="remove_photo" 
                                                    value="1" 
                                                    class="btn btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to remove your profile photo?')">
                                                <i class="hicon hicon-delete me-1"></i>
                                                Remove Photo
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Profile Content -->

@endsection

@push('scripts')
<script>
    // Image preview with enhanced validation
    function previewImage(event) {
        const file = event.target.files[0];
        const uploadBtn = document.getElementById('uploadBtn');
        const fileInfo = document.getElementById('fileInfo');
        const fileInput = document.getElementById('profile_photo');
        
        if (file) {
            // Validate file type by extension
            const fileName = file.name.toLowerCase();
            const validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            const fileExtension = fileName.split('.').pop();
            
            if (!validExtensions.includes(fileExtension)) {
                fileInfo.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-warning me-1"></i>
                        <strong>Invalid file type!</strong><br>
                        Your file is .${fileExtension} but only JPG, PNG, and GIF images are allowed.
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
                uploadBtn.disabled = true;
                fileInput.value = '';
                return;
            }
            
            // Validate MIME type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                fileInfo.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-warning me-1"></i>
                        <strong>Invalid file format!</strong><br>
                        The file you selected is not a valid image. Please select a JPG, PNG, or GIF image.
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
                uploadBtn.disabled = true;
                fileInput.value = '';
                return;
            }
            
            // Validate file size (2MB max)
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            if (file.size > maxSize) {
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const maxSizeMB = (maxSize / (1024 * 1024)).toFixed(0);
                fileInfo.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-warning me-1"></i>
                        <strong>File too large!</strong><br>
                        Your image is ${fileSizeMB}MB but the maximum allowed size is ${maxSizeMB}MB. 
                        Please compress or choose a smaller image.
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
                uploadBtn.disabled = true;
                fileInput.value = '';
                return;
            }
            
            // Warn if file is close to limit
            const warningSize = 1.8 * 1024 * 1024; // 1.8MB
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            const sizeText = file.size < 1024 * 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`;
            
            if (file.size > warningSize) {
                fileInfo.innerHTML = `
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-information me-1"></i>
                        <strong>File selected:</strong> ${file.name} (${sizeText})<br>
                        <small>Note: Your file is close to the 2MB limit. Upload may be slower.</small>
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
            } else {
                fileInfo.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-confirmation-instant me-1"></i>
                        <strong>Ready to upload:</strong><br>
                        ${file.name} (${sizeText})
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
            }
            
            // Enable upload button
            uploadBtn.disabled = false;
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('photoPreviewContainer');
                previewContainer.innerHTML = `<img src="${e.target.result}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;" id="photoPreview">`;
            };
            reader.onerror = function() {
                fileInfo.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-0" role="alert">
                        <i class="hicon hicon-warning me-1"></i>
                        <strong>Failed to read file!</strong><br>
                        Could not preview the image. The file may be corrupted.
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                `;
                uploadBtn.disabled = true;
                fileInput.value = '';
            };
            reader.readAsDataURL(file);
        } else {
            fileInfo.innerHTML = '';
            uploadBtn.disabled = true;
        }
    }

    // Show active tab based on errors
    @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
        document.getElementById('password-tab').click();
    @elseif($errors->has('profile_photo') || $errors->has('remove_photo'))
        document.getElementById('photo-tab').click();
    @elseif($errors->has('name') || $errors->has('email'))
        document.getElementById('info-tab').click();
    @endif
    
    // Form submission feedback
    document.getElementById('photoUploadForm')?.addEventListener('submit', function(e) {
        const uploadBtn = document.getElementById('uploadBtn');
        const fileInfo = document.getElementById('fileInfo');
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Uploading...';
        
        fileInfo.innerHTML = `
            <div class="alert alert-info mt-2 mb-0" role="alert">
                <i class="hicon hicon-time-clock me-1"></i>
                <strong>Please wait...</strong> Uploading your photo. Do not close this page.
            </div>
        `;
    });

    // Auto-dismiss alerts after 10 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 10000);
</script>
@endpush

