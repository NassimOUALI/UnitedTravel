<div class="row">
    <div class="col-12 col-lg-8">
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">
                Full Name <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $user->name ?? '') }}"
                   placeholder="Enter full name"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">
                Email Address <span class="text-danger">*</span>
            </label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email', $user->email ?? '') }}"
                   placeholder="user@example.com"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">
                Password 
                @if(isset($user))
                    <small class="text-muted">(Leave blank to keep current password)</small>
                @else
                    <span class="text-danger">*</span>
                @endif
            </label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Enter password"
                   {{ isset($user) ? '' : 'required' }}>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Minimum 8 characters</small>
        </div>

        <!-- Password Confirmation -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">
                Confirm Password
                @if(isset($user))
                    <small class="text-muted">(Required only if changing password)</small>
                @else
                    <span class="text-danger">*</span>
                @endif
            </label>
            <input type="password" 
                   class="form-control" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   placeholder="Confirm password"
                   {{ isset($user) ? '' : 'required' }}>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <!-- Roles -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">User Roles</h6>
            </div>
            <div class="card-body">
                @foreach($roles as $role)
                    <div class="form-check mb-2">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="roles[]" 
                               value="{{ $role->id }}" 
                               id="role{{ $role->id }}"
                               {{ isset($user) && $user->roles->contains($role->id) ? 'checked' : '' }}
                               {{ old('roles') && in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role{{ $role->id }}">
                            <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($role->name) }}
                            </span>
                        </label>
                    </div>
                @endforeach
                @error('roles')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-3">
                    Select one or more roles for this user.
                </small>
            </div>
        </div>

        <!-- Help Text -->
        <div class="card border-0 bg-light">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="hicon hicon-info me-1"></i>
                    Role Information
                </h6>
                <ul class="small mb-0 ps-3">
                    <li><strong>Admin:</strong> Full access to admin panel</li>
                    <li><strong>Client:</strong> Regular user access</li>
                    <li>Users can have multiple roles</li>
                    <li>At least one role recommended</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center pt-4 border-top">
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
        <i class="hicon hicon-edge-arrow-left me-1"></i>
        Cancel
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="hicon hicon-confirmation-instant me-1"></i>
        {{ isset($user) ? 'Update' : 'Create' }} User
    </button>
</div>

