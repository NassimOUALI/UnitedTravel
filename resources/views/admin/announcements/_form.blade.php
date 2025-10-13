<div class="row g-4">
    <div class="col-12 col-lg-8">
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="form-label fw-semibold">
                <i class="hicon hicon-megaphone me-1 text-primary"></i>
                Announcement Title <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $announcement->title ?? '') }}"
                   placeholder="Enter announcement title (e.g., 'New Summer Tours Available!')"
                   maxlength="150"
                   required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text d-flex justify-content-between align-items-center mt-2">
                <span><i class="hicon hicon-information me-1"></i> Maximum 150 characters</span>
                <span id="titleCounter" class="text-muted"></span>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label for="content" class="form-label fw-semibold">
                <i class="hicon hicon-edit me-1 text-primary"></i>
                Content <span class="text-danger">*</span>
            </label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      id="content" 
                      name="content" 
                      rows="8"
                      placeholder="Enter announcement content..."
                      maxlength="1000"
                      required>{{ old('content', $announcement->content ?? '') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text d-flex justify-content-between align-items-center mt-2">
                <span><i class="hicon hicon-information me-1"></i> Maximum 1000 characters</span>
                <span id="contentCounter" class="text-muted"></span>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="card border-primary border-2 bg-light">
            <div class="card-header bg-primary text-white">
                <i class="hicon hicon-view me-1"></i>
                <strong>Preview</strong>
            </div>
            <div class="card-body">
                <h5 id="previewTitle" class="text-muted">{{ $announcement->title ?? 'Your title will appear here...' }}</h5>
                <p id="previewContent" class="mb-0 text-muted">{{ $announcement->content ?? 'Your content will appear here...' }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <!-- Visibility -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h6 class="mb-0 text-white">
                    <i class="hicon hicon-view me-1"></i>
                    Visibility Settings
                </h6>
            </div>
            <div class="card-body">
                <div class="form-check form-switch form-switch-lg">
                    <input class="form-check-input" 
                           type="checkbox" 
                           role="switch"
                           id="visible" 
                           name="visible" 
                           value="1"
                           {{ old('visible', $announcement->visible ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="visible">
                        Show on Homepage
                    </label>
                </div>
                <div class="alert alert-info mt-3 mb-0">
                    <i class="hicon hicon-information me-1"></i>
                    <small>
                        Only visible announcements will appear on the public homepage for visitors.
                    </small>
                </div>
            </div>
        </div>

        <!-- Statistics (if editing) -->
        @if(isset($announcement) && $announcement->id)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="hicon hicon-ycs-dashboard me-1"></i>
                    Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Created</small>
                    <strong>{{ $announcement->created_at->format('M d, Y g:i A') }}</strong>
                </div>
                <div class="mb-0">
                    <small class="text-muted d-block mb-1">Last Updated</small>
                    <strong>{{ $announcement->updated_at->format('M d, Y g:i A') }}</strong>
                </div>
            </div>
        </div>
        @endif

        <!-- Help Text -->
        <div class="card border-0 bg-light-primary">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="hicon hicon-information-circle me-1 text-primary"></i>
                    Best Practices
                </h6>
                <ul class="small mb-0 ps-3">
                    <li class="mb-2"><strong>Keep it short:</strong> Concise titles grab attention</li>
                    <li class="mb-2"><strong>Be clear:</strong> Use simple language</li>
                    <li class="mb-2"><strong>Highlight value:</strong> Focus on benefits</li>
                    <li class="mb-2"><strong>Call to action:</strong> Guide users to next steps</li>
                    <li><strong>Toggle visibility:</strong> Hide when no longer relevant</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center pt-4 mt-4 border-top">
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary btn-lg">
        <i class="hicon hicon-edge-arrow-left me-1"></i>
        Cancel
    </a>
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="hicon hicon-confirmation-instant me-1"></i>
        {{ isset($announcement) && $announcement->id ? 'Update' : 'Create' }} Announcement
    </button>
</div>

@push('styles')
<style>
    .form-switch-lg .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }
    
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.05);
    }

    #previewTitle, #previewContent {
        transition: all 0.3s ease;
    }

    #previewTitle:not(.text-muted), 
    #previewContent:not(.text-muted) {
        color: #212529 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const contentInput = document.getElementById('content');
        const titleCounter = document.getElementById('titleCounter');
        const contentCounter = document.getElementById('contentCounter');
        const previewTitle = document.getElementById('previewTitle');
        const previewContent = document.getElementById('previewContent');
        
        // Character counter and preview updater
        function updateCounter(input, counter, maxLength) {
            const length = input.value.length;
            const remaining = maxLength - length;
            counter.textContent = `${length}/${maxLength}`;
            
            if (remaining < 20) {
                counter.classList.add('text-warning');
                counter.classList.remove('text-muted');
            } else {
                counter.classList.add('text-muted');
                counter.classList.remove('text-warning');
            }
        }
        
        function updatePreview() {
            if (titleInput.value.trim()) {
                previewTitle.textContent = titleInput.value;
                previewTitle.classList.remove('text-muted');
            } else {
                previewTitle.textContent = 'Your title will appear here...';
                previewTitle.classList.add('text-muted');
            }
            
            if (contentInput.value.trim()) {
                previewContent.textContent = contentInput.value;
                previewContent.classList.remove('text-muted');
            } else {
                previewContent.textContent = 'Your content will appear here...';
                previewContent.classList.add('text-muted');
            }
        }
        
        // Initialize
        updateCounter(titleInput, titleCounter, 150);
        updateCounter(contentInput, contentCounter, 1000);
        updatePreview();
        
        // Event listeners
        titleInput.addEventListener('input', function() {
            updateCounter(this, titleCounter, 150);
            updatePreview();
        });
        
        contentInput.addEventListener('input', function() {
            updateCounter(this, contentCounter, 1000);
            updatePreview();
        });
    });
</script>
@endpush
