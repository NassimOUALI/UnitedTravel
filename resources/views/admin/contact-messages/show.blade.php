@extends('layouts.admin')

@section('title', 'View Message')
@section('page-title', 'Contact Message Details')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.contact-messages.index') }}">Contact Messages</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Message #{{ $contactMessage->id }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">
        <!-- Message Details -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="hicon hicon-email-envelope me-2"></i>
                        Message from {{ $contactMessage->name }}
                    </h5>
                    @if($contactMessage->isNew())
                        <span class="badge bg-warning text-dark">NEW</span>
                    @elseif($contactMessage->status === 'replied')
                        <span class="badge bg-success">REPLIED</span>
                    @elseif($contactMessage->status === 'archived')
                        <span class="badge bg-secondary">ARCHIVED</span>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Sender Info -->
                <div class="row mb-4 pb-4 border-bottom">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="text-muted small mb-1">From:</p>
                        <h6 class="mb-0">{{ $contactMessage->name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted small mb-1">Received:</p>
                        <h6 class="mb-0">{{ $contactMessage->created_at->format('M d, Y g:i A') }}</h6>
                        <small class="text-muted">{{ $contactMessage->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <!-- Contact Details -->
                <div class="mb-4 pb-4 border-bottom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">
                                <i class="hicon hicon-email-envelope me-1"></i>
                                Email:
                            </p>
                            <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                {{ $contactMessage->email }}
                            </a>
                        </div>
                        @if($contactMessage->phone)
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">
                                <i class="hicon hicon-phone me-1"></i>
                                Phone:
                            </p>
                            <a href="tel:{{ $contactMessage->phone }}" class="text-decoration-none">
                                {{ $contactMessage->phone }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Subject -->
                <div class="mb-4">
                    <p class="text-muted small mb-2">Subject:</p>
                    <h5>{{ $contactMessage->subject }}</h5>
                </div>

                <!-- Message -->
                <div class="mb-4">
                    <p class="text-muted small mb-2">Message:</p>
                    <div class="bg-light p-4 rounded">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div>
                    <form action="{{ route('admin.contact-messages.update', $contactMessage) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="admin_notes" class="form-label fw-semibold">
                                <i class="hicon hicon-edit me-1"></i>
                                Admin Notes (Internal):
                            </label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                      id="admin_notes" 
                                      name="admin_notes" 
                                      rows="4" 
                                      placeholder="Add internal notes about this message...">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status:</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                <option value="archived" {{ $contactMessage->status === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="hicon hicon-confirmation-instant me-1"></i>
                            Update Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="hicon hicon-flash me-1"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject) }}" 
                   class="btn btn-success w-100 mb-2">
                    <i class="hicon hicon-email-envelope me-1"></i>
                    Reply via Email
                </a>
                
                @if($contactMessage->status !== 'replied')
                <form action="{{ route('admin.contact-messages.mark-replied', $contactMessage) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-success w-100 mb-2">
                        <i class="hicon hicon-confirmation-instant me-1"></i>
                        Mark as Replied
                    </button>
                </form>
                @endif

                @if($contactMessage->status !== 'archived')
                <form action="{{ route('admin.contact-messages.archive', $contactMessage) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="hicon hicon-archive me-1"></i>
                        Archive Message
                    </button>
                </form>
                @endif

                @if($contactMessage->phone)
                <a href="tel:{{ $contactMessage->phone }}" class="btn btn-outline-info w-100 mb-2">
                    <i class="hicon hicon-phone me-1"></i>
                    Call {{ $contactMessage->phone }}
                </a>
                @endif

                <hr>

                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="hicon hicon-edge-arrow-left me-1"></i>
                    Back to Messages
                </a>
            </div>
        </div>

        <!-- Message Info -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="hicon hicon-information me-1"></i>
                    Message Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Message ID</small>
                    <strong>#{{ $contactMessage->id }}</strong>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Status</small>
                    @if($contactMessage->status === 'new')
                        <span class="badge bg-warning text-dark">New</span>
                    @elseif($contactMessage->status === 'read')
                        <span class="badge bg-info">Read</span>
                    @elseif($contactMessage->status === 'replied')
                        <span class="badge bg-success">Replied</span>
                    @elseif($contactMessage->status === 'archived')
                        <span class="badge bg-secondary">Archived</span>
                    @endif
                </div>
                @if($contactMessage->read_at)
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Read At</small>
                    <strong>{{ $contactMessage->read_at->format('M d, Y g:i A') }}</strong>
                </div>
                @endif
                @if($contactMessage->replied_at)
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Replied At</small>
                    <strong>{{ $contactMessage->replied_at->format('M d, Y g:i A') }}</strong>
                </div>
                @endif
                <div class="mb-0">
                    <small class="text-muted d-block mb-1">Received</small>
                    <strong>{{ $contactMessage->created_at->format('M d, Y g:i A') }}</strong>
                    <br>
                    <small class="text-muted">{{ $contactMessage->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0">
                    <i class="hicon hicon-warning me-1"></i>
                    Danger Zone
                </h6>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-3">Once deleted, this message cannot be recovered.</p>
                <button type="button"
                        class="btn btn-danger w-100"
                        onclick="if(confirm('Are you sure you want to delete this message from {{ addslashes($contactMessage->name) }}?\n\nSubject: {{ addslashes($contactMessage->subject) }}\n\nThis action cannot be undone.')) { document.getElementById('delete-form').submit(); }">
                    <i class="hicon hicon-trash me-1"></i>
                    Delete Message
                </button>
                <form id="delete-form" 
                      action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" 
                      method="POST" 
                      class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

