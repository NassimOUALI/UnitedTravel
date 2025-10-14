@php
    // Ensure $destination is defined (for create mode)
    $destination = $destination ?? new \App\Models\Destination();
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <!-- Destination Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">
                <i class="hicon hicon-flights-pin me-1 text-primary"></i>
                Destination Name <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $destination->name ?? '') }}" 
                   placeholder="e.g., Marrakech, Fes, Casablanca"
                   maxlength="100"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text d-flex justify-content-between align-items-center mt-2">
                <span><i class="hicon hicon-information me-1"></i> Enter the destination name</span>
                <span id="nameCounter" class="text-muted"></span>
            </div>
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="form-label fw-semibold">
                <i class="hicon hicon-location me-1 text-primary"></i>
                Location/Country <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control form-control-lg @error('location') is-invalid @enderror" 
                   id="location" 
                   name="location" 
                   value="{{ old('location', $destination->location ?? '') }}" 
                   placeholder="e.g., Morocco, France, Spain"
                   maxlength="100"
                   required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text d-flex justify-content-between align-items-center mt-2">
                <span><i class="hicon hicon-information me-1"></i> Enter the country or region</span>
                <span id="locationCounter" class="text-muted"></span>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="form-label fw-semibold">
                <i class="hicon hicon-edit me-1 text-primary"></i>
                Description <span class="text-danger">*</span>
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" 
                      name="description" 
                      rows="8" 
                      placeholder="Describe what makes this destination special. Include highlights, attractions, culture, and what travelers can expect..."
                      maxlength="2000"
                      required>{{ old('description', $destination->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text d-flex justify-content-between align-items-center mt-2">
                <span><i class="hicon hicon-information me-1"></i> Maximum 2000 characters</span>
                <span id="descriptionCounter" class="text-muted"></span>
            </div>
        </div>

        <!-- Multiple Image Upload -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                <i class="hicon hicon-photo me-1 text-primary"></i>
                Destination Images (Up to 5) <span class="text-danger">*</span>
            </label>
            
            <!-- Existing Images (for edit mode) -->
            @if(isset($destination) && $destination->exists && $destination->images && $destination->images->count() > 0)
                <div class="mb-3">
                    <p class="small fw-bold mb-2">Current Images:</p>
                    <div class="row g-2" id="existingImages">
                        @foreach($destination->images as $index => $image)
                            <div class="col-md-4" data-image-id="{{ $image->id }}">
                                <div class="card {{ $image->is_primary ? 'border-primary border-2' : '' }}">
                                    <img src="{{ asset('public/' . $image->path) }}" class="card-img-top" alt="Destination image {{ $index + 1 }}">
                                    <div class="card-body p-2">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small class="text-muted">Image {{ $index + 1 }}</small>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="markImageForDeletion({{ $image->id }})">
                                                <i class="hicon hicon-trash"></i>
                                            </button>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="primary_image_existing" 
                                                   id="primary_existing_{{ $image->id }}" 
                                                   value="{{ $image->id }}"
                                                   {{ $image->is_primary ? 'checked' : '' }}
                                                   onchange="updatePrimaryImageLabel(this, 'existing')">
                                            <label class="form-check-label small" for="primary_existing_{{ $image->id }}">
                                                {{ $image->is_primary ? '⭐ Primary' : 'Set as Primary' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Hidden inputs to track images to delete -->
                    <input type="hidden" name="images_to_delete" id="images_to_delete" value="">
                </div>
            @endif
            
            <!-- New Images Upload -->
            <input type="file" 
                   class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                   id="images" 
                   name="images[]" 
                   accept="image/jpeg,image/png,image/jpg,image/webp"
                   multiple
                   onchange="previewImages(this)"
                   {{ !isset($destination) || !$destination->exists ? 'required' : '' }}>
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="alert alert-info mt-2 mb-0">
                <i class="hicon hicon-information me-1"></i>
                <small>
                    <strong>Image Requirements:</strong>
                    <ul class="mb-0 mt-1">
                        <li>Select up to 5 images</li>
                        <li>Formats: JPEG, PNG, JPG, WebP</li>
                        <li>Maximum size per image: 2MB</li>
                        <li>Recommended: 1920x1080px (16:9 ratio) for best results</li>
                        <li>The first image will be used as the primary/featured image</li>
                    </ul>
                </small>
            </div>
            
            <!-- Image Previews -->
            <div id="imagePreviews" class="mt-3 row g-2" style="display: none;"></div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <!-- Statistics (if editing) -->
        @if(isset($destination) && $destination->id)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h6 class="mb-0">
                    <i class="hicon hicon-ycs-dashboard me-1"></i>
                    Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Total Tours</small>
                    <h4 class="mb-0">{{ $destination->tours->count() }}</h4>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Created</small>
                    <strong>{{ $destination->created_at->format('M d, Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $destination->created_at->diffForHumans() }}</small>
                </div>
                <div class="mb-0">
                    <small class="text-muted d-block mb-1">Last Updated</small>
                    <strong>{{ $destination->updated_at->format('M d, Y') }}</strong>
                    <br>
                    <small class="text-muted">{{ $destination->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Links (if editing) -->
        @if(isset($destination) && $destination->id)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="hicon hicon-link me-1"></i>
                    Quick Links
                </h6>
            </div>
            <div class="card-body">
                <a href="{{ route('destinations.show', $destination) }}" 
                   class="btn btn-outline-primary w-100 mb-2" 
                   target="_blank">
                    <i class="hicon hicon-eye me-1"></i>
                    View Public Page
                </a>
                @if($destination->tours->count() > 0)
                <a href="{{ route('admin.tours.index') }}?destination={{ $destination->id }}" 
                   class="btn btn-outline-secondary w-100">
                    <i class="hicon hicon-menu-calendar me-1"></i>
                    View Associated Tours
                </a>
                @else
                <a href="{{ route('admin.tours.create') }}?destination={{ $destination->id }}" 
                   class="btn btn-outline-success w-100">
                    <i class="hicon hicon-add me-1"></i>
                    Add Tour Here
                </a>
                @endif
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
                    <li class="mb-2"><strong>Compelling names:</strong> Use recognizable destination names</li>
                    <li class="mb-2"><strong>Clear location:</strong> Specify country/region for context</li>
                    <li class="mb-2"><strong>Rich descriptions:</strong> Highlight unique features and attractions</li>
                    <li class="mb-2"><strong>Quality images:</strong> Use high-resolution, attractive photos</li>
                    <li><strong>SEO friendly:</strong> Include keywords naturally in descriptions</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center pt-4 mt-4 border-top">
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary btn-lg">
        <i class="hicon hicon-edge-arrow-left me-1"></i>
        Cancel
    </a>
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="hicon hicon-confirmation-instant me-1"></i>
        {{ isset($destination) && $destination->id ? 'Update' : 'Create' }} Destination
    </button>
</div>

@push('styles')
<style>
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counters
        const fields = [
            {input: document.getElementById('name'), counter: document.getElementById('nameCounter'), max: 100},
            {input: document.getElementById('location'), counter: document.getElementById('locationCounter'), max: 100},
            {input: document.getElementById('description'), counter: document.getElementById('descriptionCounter'), max: 2000}
        ];
        
        function updateCounter(input, counter, maxLength) {
            const length = input.value.length;
            counter.textContent = `${length}/${maxLength}`;
            
            if (length > maxLength * 0.9) {
                counter.classList.add('text-warning');
                counter.classList.remove('text-muted');
            } else {
                counter.classList.add('text-muted');
                counter.classList.remove('text-warning');
            }
        }
        
        fields.forEach(field => {
            if (field.input && field.counter) {
                updateCounter(field.input, field.counter, field.max);
                field.input.addEventListener('input', function() {
                    updateCounter(this, field.counter, field.max);
                });
            }
        });
    });
    
    // Track images marked for deletion
    let imagesToDelete = [];

    function markImageForDeletion(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            // Add to deletion list
            imagesToDelete.push(imageId);
            document.getElementById('images_to_delete').value = imagesToDelete.join(',');
            
            // Hide the image card
            const imageCard = document.querySelector(`[data-image-id="${imageId}"]`);
            if (imageCard) {
                imageCard.style.opacity = '0.3';
                imageCard.querySelector('.btn-danger').disabled = true;
                imageCard.querySelector('.btn-danger').innerHTML = '<i class="hicon hicon-check"></i> Marked for deletion';
            }
        }
    }

    function previewImages(input) {
        const previewContainer = document.getElementById('imagePreviews');
        previewContainer.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            if (input.files.length > 5) {
                alert('You can only upload up to 5 images. Only the first 5 will be used.');
            }
            
            const filesToPreview = Math.min(input.files.length, 5);
            
            for (let i = 0; i < filesToPreview; i++) {
                const file = input.files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-4';
                    
                    col.innerHTML = `
                        <div class="card ${i === 0 ? 'border-primary border-2' : ''}">
                            <img src="${e.target.result}" class="card-img-top" alt="Preview ${i + 1}">
                            <div class="card-body p-2">
                                <small class="text-muted d-block mb-2">
                                    New Image ${i + 1}
                                </small>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="primary_image_new" 
                                           id="primary_new_${i}" 
                                           value="${i}"
                                           ${i === 0 ? 'checked' : ''}
                                           onchange="updatePrimaryImageLabel(this, 'new')">
                                    <label class="form-check-label small" for="primary_new_${i}">
                                        ${i === 0 ? '⭐ Primary' : 'Set as Primary'}
                                    </label>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    previewContainer.appendChild(col);
                }
                
                reader.readAsDataURL(file);
            }
            
            previewContainer.style.display = 'flex';
        } else {
            previewContainer.style.display = 'none';
        }
    }

    function updatePrimaryImageLabel(radio, type) {
        // Update all labels of the same type
        const radios = document.querySelectorAll(`input[name="primary_image_${type}"]`);
        radios.forEach(r => {
            const label = document.querySelector(`label[for="${r.id}"]`);
            const card = r.closest('.card');
            if (r.checked) {
                label.textContent = '⭐ Primary';
                card.classList.add('border-primary', 'border-2');
            } else {
                label.textContent = 'Set as Primary';
                card.classList.remove('border-primary', 'border-2');
            }
        });
    }
</script>
@endpush
