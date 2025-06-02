@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            @include('admin.donation.components.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Donation Details</h5>
                    <div>
                        <a href="{{ route('admin.donations.edit', $donation) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Donor Information</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <p>{{ $donation->donor_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p>{{ $donation->donor_email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Donation Information</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Type</label>
                                <p>
                                    <span class="badge bg-{{ $donation->type === 'monetary' ? 'primary' : 'success' }}">
                                        {{ ucfirst($donation->type) }}
                                    </span>
                                </p>
                            </div>
                            @if($donation->type === 'monetary')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Amount</label>
                                <p>₱{{ number_format($donation->amount, 2) }}</p>
                            </div>
                            @else
                            <div class="mb-3">
                                <label class="form-label fw-bold">Item Name</label>
                                <p>{{ $donation->item_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <p>{{ $donation->quantity }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Expected Drop-off Date</label>
                                <p>{{ $donation->expected_date?->format('M d, Y') }}</p>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p>
                                    <span class="badge bg-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($donation->notes)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Additional Notes</h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $donation->notes }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 