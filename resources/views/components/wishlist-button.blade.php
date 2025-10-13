@props(['tourId', 'classes' => ''])

@auth
    <button type="button" 
            class="wishlist-btn {{ $classes }}" 
            data-tour-id="{{ $tourId }}"
            title="Add to wishlist">
        <i class="hicon hicon-menu-favorite"></i>
    </button>
@else
    <a href="{{ route('login') }}" 
       class="wishlist-btn {{ $classes }}"
       title="Login to add to wishlist">
        <i class="hicon hicon-menu-favorite"></i>
    </a>
@endauth

@once
@push('styles')
<style>
    .wishlist-btn {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.8);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6c757d;
        text-decoration: none;
    }

    .wishlist-btn:hover {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
        transform: scale(1.1);
    }

    .wishlist-btn.in-wishlist {
        background: var(--bs-danger);
        border-color: var(--bs-danger);
        color: white;
    }

    .wishlist-btn.in-wishlist:hover {
        background: #dc3545;
        border-color: #dc3545;
    }

    .wishlist-btn i {
        font-size: 18px;
    }

    .wishlist-btn.loading {
        pointer-events: none;
        opacity: 0.6;
    }

    .wishlist-btn.loading i {
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check wishlist status for all buttons
        document.querySelectorAll('.wishlist-btn[data-tour-id]').forEach(button => {
            const tourId = button.dataset.tourId;
            
            // Check if tour is in wishlist
            fetch(`/wishlist/check/${tourId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.in_wishlist) {
                    button.classList.add('in-wishlist');
                    button.title = 'Remove from wishlist';
                }
            })
            .catch(error => console.error('Error checking wishlist:', error));

            // Handle click
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const button = this;
                const tourId = button.dataset.tourId;
                const isInWishlist = button.classList.contains('in-wishlist');
                
                button.classList.add('loading');
                
                const url = isInWishlist ? `/wishlist/${tourId}` : '/wishlist';
                const method = isInWishlist ? 'DELETE' : 'POST';
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        _method: method,
                        tour_id: tourId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    button.classList.remove('loading');
                    
                    if (data.success) {
                        if (isInWishlist) {
                            button.classList.remove('in-wishlist');
                            button.title = 'Add to wishlist';
                            showToast('Removed from wishlist', 'success');
                        } else {
                            button.classList.add('in-wishlist');
                            button.title = 'Remove from wishlist';
                            showToast('Added to wishlist!', 'success');
                        }
                    } else {
                        showToast(data.message || 'An error occurred', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.classList.remove('loading');
                    showToast('An error occurred. Please try again.', 'error');
                });
            });
        });

        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
            toast.style.zIndex = '9999';
            toast.style.minWidth = '300px';
            toast.innerHTML = `
                <i class="hicon hicon-${type === 'success' ? 'confirmation-instant' : 'warning'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    });
</script>
@endpush
@endonce



