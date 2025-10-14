@php
    // Ensure $tour is defined (for create mode)
    $tour = $tour ?? new \App\Models\Tour();
@endphp

<!-- Tour Title -->
<div class="mb-4">
    <label for="title" class="form-label fw-bold">
        Tour Title <span class="text-danger">*</span>
    </label>
    <input type="text" 
           class="form-control @error('title') is-invalid @enderror" 
           id="title" 
           name="title" 
           value="{{ old('title', $tour->title ?? '') }}" 
           placeholder="e.g., Paris City Explorer, Tokyo Food Adventure"
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Enter a catchy title for your tour</small>
</div>

<!-- Description -->
<div class="mb-4">
    <label for="description" class="form-label fw-bold">
        Description <span class="text-danger">*</span>
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" 
              name="description" 
              rows="6" 
              placeholder="Describe the tour itinerary, highlights, and what's included..."
              required>{{ old('description', $tour->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Provide a detailed description of the tour</small>
</div>

<!-- Duration -->
<div class="mb-4">
    <label for="duration" class="form-label fw-bold">
        Duration <span class="text-danger">*</span>
    </label>
    <input type="text" 
           class="form-control @error('duration') is-invalid @enderror" 
           id="duration" 
           name="duration" 
           value="{{ old('duration', $tour->duration ?? '') }}" 
           placeholder="e.g., 5 Days 4 Nights, 3 Hours, Full Day"
           required>
    @error('duration')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Specify how long the tour lasts</small>
</div>

<!-- Price Section -->
<div class="row mb-4">
    <div class="col-md-6">
        <label for="price" class="form-label fw-bold">
            Price (USD)
        </label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" 
                   class="form-control @error('price') is-invalid @enderror" 
                   id="price" 
                   name="price" 
                   value="{{ old('price', $tour->price ?? '') }}" 
                   placeholder="0.00"
                   step="0.01"
                   min="0">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <small class="text-muted">Enter the tour price per person</small>
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold d-block">&nbsp;</label>
        <div class="form-check form-switch">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="is_price_defined" 
                   name="is_price_defined"
                   value="1"
                   {{ old('is_price_defined', $tour->is_price_defined ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_price_defined">
                Price is defined (check if price is final)
            </label>
        </div>
        <small class="text-muted d-block mt-2">
            Leave unchecked if price varies or is "To Be Determined"
        </small>
    </div>
</div>

<!-- Destinations (Multi-select with Checkboxes) -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <label class="form-label fw-bold mb-0">
            Destinations
        </label>
        @if($destinations->count() > 0)
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="toggleAllDestinations(true)">
                    <i class="hicon hicon-check"></i> Select All
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleAllDestinations(false)">
                    <i class="hicon hicon-close"></i> Clear All
                </button>
            </div>
        @endif
    </div>
    
    @php
        $selectedDestinations = old('destinations', 
            ($tour->exists && $tour->relationLoaded('destinations')) 
                ? $tour->destinations->pluck('id')->toArray() 
                : []
        );
    @endphp
    
    @if($destinations->count() > 0)
        <div class="border rounded p-3 bg-light destinations-container" style="max-height: 350px; overflow-y: auto;">
            <div class="row g-2">
                @foreach($destinations as $destination)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-check destination-checkbox">
                            <input class="form-check-input destination-check" 
                                   type="checkbox" 
                                   name="destinations[]" 
                                   value="{{ $destination->id }}"
                                   id="destination_{{ $destination->id }}"
                                   {{ in_array($destination->id, $selectedDestinations) ? 'checked' : '' }}>
                            <label class="form-check-label w-100" for="destination_{{ $destination->id }}">
                                <div class="destination-label-content">
                                    <strong class="d-block text-dark">{{ $destination->name }}</strong>
                                    <small class="text-muted">
                                        <i class="hicon hicon-flights-pin" style="font-size: 0.75rem;"></i>
                                        {{ $destination->location }}
                                    </small>
                                </div>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <small class="text-muted">
                <i class="hicon hicon-info-circle"></i> 
                Tap to select/deselect destinations
            </small>
            <small class="text-muted">
                <span id="selectedDestinationCount">{{ count($selectedDestinations) }}</span> selected
            </small>
        </div>
    @else
        <div class="alert alert-warning mb-0">
            <i class="hicon hicon-warning"></i> 
            No destinations available. <a href="{{ route('admin.destinations.create') }}" class="alert-link">Create one first</a>.
        </div>
    @endif
    
    @error('destinations')
        <div class="text-danger small mt-2">{{ $message }}</div>
    @enderror
</div>

<style>
    /* Enhanced checkbox styling for mobile */
    .destination-checkbox {
        padding: 0.75rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        background: white;
        border: 1px solid #dee2e6;
        margin-bottom: 0;
    }
    
    .destination-checkbox:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.1rem rgba(13, 110, 253, 0.1);
    }
    
    .destination-checkbox .form-check-input {
        margin-top: 0.25rem;
        width: 1.25rem;
        height: 1.25rem;
        cursor: pointer;
    }
    
    .destination-checkbox .form-check-label {
        cursor: pointer;
        padding-left: 0.5rem;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    
    .destination-checkbox input:checked ~ label {
        font-weight: 500;
    }
    
    .destination-checkbox input:checked ~ label .destination-label-content strong {
        color: #0d6efd;
    }
    
    .destination-label-content {
        line-height: 1.4;
    }
    
    /* Better scrollbar for destinations container */
    .destinations-container {
        scrollbar-width: thin;
        scrollbar-color: #0d6efd #f8f9fa;
    }
    
    .destinations-container::-webkit-scrollbar {
        width: 8px;
    }
    
    .destinations-container::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 4px;
    }
    
    .destinations-container::-webkit-scrollbar-thumb {
        background: #0d6efd;
        border-radius: 4px;
    }
    
    /* Mobile optimizations */
    @media (max-width: 576px) {
        .destination-checkbox {
            padding: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .destination-checkbox .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
        }
        
        .destination-label-content strong {
            font-size: 1rem;
        }
        
        .destination-label-content small {
            font-size: 0.85rem;
        }
        
        /* Stack buttons on mobile */
        .btn-group {
            flex-direction: column;
            width: auto;
        }
        
        .btn-group .btn {
            border-radius: 0.25rem !important;
            margin-bottom: 0.25rem;
        }
        
        .btn-group .btn:last-child {
            margin-bottom: 0;
        }
    }
</style>

<!-- Discount (Optional) -->
<div class="mb-4">
    <label for="discount_id" class="form-label fw-bold">
        Apply Discount (Optional)
    </label>
    <select class="form-select @error('discount_id') is-invalid @enderror" 
            id="discount_id" 
            name="discount_id">
        <option value="">No discount</option>
        @foreach($discounts as $discount)
            <option value="{{ $discount->id }}"
                {{ old('discount_id', $tour->discount_id ?? '') == $discount->id ? 'selected' : '' }}>
                {{ $discount->name }} ({{ $discount->percentage }}% OFF)
                @if($discount->valid_until)
                    - Valid until {{ $discount->valid_until->format('M d, Y') }}
                @endif
            </option>
        @endforeach
    </select>
    @error('discount_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Select a discount if this tour is on sale</small>
</div>

<!-- Multiple Image Upload -->
<div class="mb-4">
    <label class="form-label fw-bold">
        Tour Images (Up to 5) <span class="text-danger">*</span>
    </label>
    
            <!-- Existing Images (for edit mode) -->
            @if(isset($tour) && $tour->exists && $tour->images && $tour->images->count() > 0)
                <div class="mb-3">
                    <p class="small fw-bold mb-2">Current Images:</p>
                    <div class="row g-2" id="existingImages">
                        @foreach($tour->images as $index => $image)
                            <div class="col-md-4" data-image-id="{{ $image->id }}">
                                <div class="card {{ $image->is_primary ? 'border-primary border-2' : '' }}">
                                    <img src="{{ asset('public/' . $image->path) }}" class="card-img-top" alt="Tour image {{ $index + 1 }}">
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
           {{ !isset($tour) || !$tour->exists ? 'required' : '' }}>
    @error('images')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('images.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted d-block mt-1">
        Select up to 5 images. Accepted formats: JPEG, PNG, JPG, WebP. Maximum size per image: 2MB.
        <br>Recommended dimensions: 1200x800px for best quality.
        <br>The first image will be used as the primary/featured image.
    </small>
    
    <!-- Image Previews -->
    <div id="imagePreviews" class="mt-3 row g-2" style="display: none;"></div>
</div>

<!-- Tour Attachments (Documents/Files) -->
<div class="mb-4">
    <label class="form-label fw-bold">
        Tour Attachments (Up to 5)
    </label>
    <p class="text-muted small mb-3">
        <i class="hicon hicon-information me-1"></i>
        Upload PDF documents, brochures, itineraries, or additional images for travelers to download.
    </p>
    
    <!-- Existing Attachments (for edit mode) -->
    @if(isset($tour) && $tour->exists && $tour->relationLoaded('attachments') && $tour->attachments && $tour->attachments->count() > 0)
        <div class="mb-3">
            <p class="small fw-bold mb-2">Current Attachments:</p>
            <div class="list-group" id="existingAttachments">
                @foreach($tour->attachments as $attachment)
                    <div class="list-group-item" data-attachment-id="{{ $attachment->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center flex-grow-1">
                                @if($attachment->isPdf())
                                    <i class="hicon hicon-file-text text-danger fs-4 me-3"></i>
                                @else
                                    <i class="hicon hicon-photo text-primary fs-4 me-3"></i>
                                @endif
                                <div>
                                    <strong>{{ $attachment->filename }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ strtoupper($attachment->type) }} • {{ $attachment->formatted_size }}
                                    </small>
                                </div>
                            </div>
                            <div>
                                <a href="{{ asset('public/' . $attachment->path) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary me-2">
                                    <i class="hicon hicon-download"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="markAttachmentForDeletion({{ $attachment->id }})">
                                    <i class="hicon hicon-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Hidden inputs to track attachments to delete -->
            <input type="hidden" name="attachments_to_delete" id="attachments_to_delete" value="">
        </div>
    @endif
    
    <!-- New Attachments Upload -->
    <input type="file" 
           class="form-control @error('attachments') is-invalid @enderror @error('attachments.*') is-invalid @enderror" 
           id="attachments" 
           name="attachments[]" 
           accept=".pdf,.jpg,.jpeg,.png"
           multiple
           onchange="previewAttachments(this)">
    @error('attachments')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('attachments.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted d-block mt-1">
        Select up to 5 files. Accepted formats: PDF, JPEG, PNG. Maximum size per file: 5MB.
    </small>
    
    <!-- Attachment Previews -->
    <div id="attachmentPreviews" class="mt-3" style="display: none;"></div>
</div>

@push('scripts')
<script>
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

    // Track attachments marked for deletion
    let attachmentsToDelete = [];

    function markAttachmentForDeletion(attachmentId) {
        if (confirm('Are you sure you want to delete this attachment?')) {
            // Add to deletion list
            attachmentsToDelete.push(attachmentId);
            document.getElementById('attachments_to_delete').value = attachmentsToDelete.join(',');
            
            // Hide the attachment item
            const attachmentItem = document.querySelector(`[data-attachment-id="${attachmentId}"]`);
            if (attachmentItem) {
                attachmentItem.style.opacity = '0.3';
                attachmentItem.querySelector('.btn-danger').disabled = true;
                attachmentItem.querySelector('.btn-danger').innerHTML = '<i class="hicon hicon-check"></i> Marked';
            }
        }
    }

    function previewAttachments(input) {
        const previewContainer = document.getElementById('attachmentPreviews');
        previewContainer.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            if (input.files.length > 5) {
                alert('You can only upload up to 5 attachments. Only the first 5 will be used.');
            }
            
            const filesToPreview = Math.min(input.files.length, 5);
            const listGroup = document.createElement('div');
            listGroup.className = 'list-group';
            
            for (let i = 0; i < filesToPreview; i++) {
                const file = input.files[i];
                const fileExt = file.name.split('.').pop().toLowerCase();
                const isPdf = fileExt === 'pdf';
                const isImage = ['jpg', 'jpeg', 'png'].includes(fileExt);
                
                const item = document.createElement('div');
                item.className = 'list-group-item';
                
                const iconClass = isPdf ? 'hicon-file-text text-danger' : 'hicon-photo text-primary';
                const fileType = isPdf ? 'PDF' : 'IMAGE';
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                
                item.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="hicon ${iconClass} fs-4 me-3"></i>
                        <div>
                            <strong>${file.name}</strong>
                            <br>
                            <small class="text-muted">${fileType} • ${fileSize} MB</small>
                        </div>
                    </div>
                `;
                
                listGroup.appendChild(item);
            }
            
            previewContainer.appendChild(listGroup);
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
        }
    }
    
    // Destinations Select All/Clear All functionality
    function toggleAllDestinations(selectAll) {
        const checkboxes = document.querySelectorAll('.destination-check');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll;
        });
        updateDestinationCount();
    }
    
    // Update destination count
    function updateDestinationCount() {
        const checkedBoxes = document.querySelectorAll('.destination-check:checked');
        const countElement = document.getElementById('selectedDestinationCount');
        if (countElement) {
            countElement.textContent = checkedBoxes.length;
        }
    }
    
    // Add event listeners to all destination checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.destination-check');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDestinationCount);
        });
    });
</script>
@endpush

