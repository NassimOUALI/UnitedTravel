<div class="row">
    <div class="col-12 col-lg-8">
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">
                Discount Name <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $discount->name ?? '') }}"
                   placeholder="e.g., Summer Sale, Early Bird Special"
                   maxlength="100"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Percentage -->
        <div class="mb-4">
            <label for="percentage" class="form-label fw-semibold">
                Discount Percentage <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input type="number" 
                       class="form-control @error('percentage') is-invalid @enderror" 
                       id="percentage" 
                       name="percentage" 
                       value="{{ old('percentage', $discount->percentage ?? '') }}"
                       placeholder="0"
                       min="0"
                       max="100"
                       step="0.01"
                       required>
                <span class="input-group-text">%</span>
                @error('percentage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <small class="text-muted">Enter a value between 0 and 100</small>
        </div>

        <!-- Valid Until -->
        <div class="mb-4">
            <label for="valid_until" class="form-label fw-semibold">
                Valid Until <span class="text-danger">*</span>
            </label>
            <input type="date" 
                   class="form-control @error('valid_until') is-invalid @enderror" 
                   id="valid_until" 
                   name="valid_until" 
                   value="{{ old('valid_until', isset($discount) ? $discount->valid_until->format('Y-m-d') : '') }}"
                   min="{{ date('Y-m-d') }}"
                   required>
            @error('valid_until')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Select the expiration date for this discount</small>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <!-- Preview Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0">
                    <i class="hicon hicon-discount me-1"></i>
                    Preview
                </h6>
            </div>
            <div class="card-body text-center">
                <div class="display-4 fw-bold text-danger mb-2">
                    <span id="previewPercentage">{{ old('percentage', $discount->percentage ?? '0') }}</span>%
                </div>
                <p class="mb-0 fw-semibold">OFF</p>
                <hr>
                <p class="small text-muted mb-0" id="previewName">
                    {{ old('name', $discount->name ?? 'Discount Name') }}
                </p>
            </div>
        </div>

        <!-- Help Text -->
        <div class="card border-0 bg-light">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="hicon hicon-info me-1"></i>
                    Tips
                </h6>
                <ul class="small mb-0 ps-3">
                    <li>Use clear, descriptive names</li>
                    <li>Standard discounts: 10%, 15%, 20%, 25%</li>
                    <li>Set realistic expiration dates</li>
                    <li>Check if tours are using this discount before deleting</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center pt-4 border-top">
    <a href="{{ route('admin.discounts.index') }}" class="btn btn-outline-secondary">
        <i class="hicon hicon-edge-arrow-left me-1"></i>
        Cancel
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="hicon hicon-confirmation-instant me-1"></i>
        {{ isset($discount) ? 'Update' : 'Create' }} Discount
    </button>
</div>

@push('scripts')
<script>
// Live preview
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const percentageInput = document.getElementById('percentage');
    const previewName = document.getElementById('previewName');
    const previewPercentage = document.getElementById('previewPercentage');

    if (nameInput && previewName) {
        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || 'Discount Name';
        });
    }

    if (percentageInput && previewPercentage) {
        percentageInput.addEventListener('input', function() {
            previewPercentage.textContent = this.value || '0';
        });
    }
});
</script>
@endpush

