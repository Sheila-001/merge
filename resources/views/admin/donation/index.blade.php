@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0">Donation Management</h2>
        <div>
            <a href="{{ route('admin.donations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Donation
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Donation Categories</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Monetary Donations -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-circle bg-primary bg-opacity-10">
                                                <i class="fas fa-money-bill text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Monetary Donations</h6>
                                            <h4 class="mb-0 fw-bold">₱{{ number_format($monetaryTotal, 2) }}</h4>
                                            <small class="@if($monetaryChange >= 0) text-success @else text-danger @endif">
                                                <i class="fas fa-@if($monetaryChange >= 0)arrow-up @else arrow-down @endif"></i>
                                                {{ number_format(abs($monetaryChange), 1) }}% from last month
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Non-Monetary Donations -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-circle bg-success bg-opacity-10">
                                                <i class="fas fa-box-open text-success"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Non-Monetary Donations</h6>
                                            <h4 class="mb-0 fw-bold">{{ $nonMonetaryCount }}</h4>
                                            <small class="@if($nonMonetaryChange >= 0) text-success @else text-danger @endif">
                                                <i class="fas fa-@if($nonMonetaryChange >= 0)arrow-up @else arrow-down @endif"></i>
                                                {{ number_format(abs($nonMonetaryChange), 1) }}% from last month
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campaign Donations -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-circle bg-info bg-opacity-10">
                                                <i class="fas fa-bullhorn text-info"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Campaign Donations</h6>
                                            <h4 class="mb-0 fw-bold">₱{{ number_format($campaignTotal, 2) }}</h4>
                                            <small class="@if($campaignChange >= 0) text-success @else text-danger @endif">
                                                <i class="fas fa-@if($campaignChange >= 0)arrow-up @else arrow-down @endif"></i>
                                                {{ number_format(abs($campaignChange), 1) }}% from last month
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Donors -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-circle bg-warning bg-opacity-10">
                                                <i class="fas fa-users text-warning"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="text-muted text-uppercase fs-12 fw-semibold mb-2">Total Donors</h6>
                                            <h4 class="mb-0 fw-bold">{{ $donorCount }}</h4>
                                            <small class="@if($donorChange >= 0) text-success @else text-danger @endif">
                                                <i class="fas fa-@if($donorChange >= 0)arrow-up @else arrow-down @endif"></i>
                                                {{ number_format(abs($donorChange), 1) }}% from last month
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Donations Section -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Recent Donations</h5>
            <div class="d-flex gap-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search donor..." id="donorSearch">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-filter="all">All</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="monetary">Monetary</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="non-monetary">Non-Monetary</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" data-filter="completed">Completed</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="pending">Pending</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Amount/Item</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->donor_name }}</td>
                            <td>{{ $donation->donor_email }}</td>
                            <td>
                                <span class="badge bg-{{ $donation->type === 'monetary' ? 'primary' : 'success' }}">
                                    {{ ucfirst($donation->type) }}
                                </span>
                            </td>
                            <td>
                                @if($donation->type === 'monetary')
                                    <span class="fw-semibold">₱{{ number_format($donation->amount, 2) }}</span>
                                @else
                                    <span class="fw-semibold">{{ $donation->item_name }}</span>
                                    <small class="text-muted d-block">{{ $donation->quantity }} units</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $donation->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td>
                                <span>{{ $donation->created_at?->format('M d, Y') ?? 'N/A' }}</span>
                                <small class="text-muted d-block">{{ $donation->created_at?->format('h:i A') ?? '' }}</small>
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.donations.show', $donation) }}">
                                                <i class="fas fa-eye me-2"></i> View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.donations.edit', $donation) }}">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </a>
                                        </li>
                                        @if($donation->type === 'non-monetary' && $donation->status === 'pending')
                                        <li>
                                            <form action="{{ route('admin.donations.update-status', $donation) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-check me-2"></i> Mark as Received
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        <li>
                                            <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this donation?')">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $donations->links() }}
            </div>
        </div>
    </div>

    <!-- Drop-Off Confirmation Section -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Drop-Off Confirmation</h5>
            <a href="{{ route('admin.donations.dropoffs') }}" class="btn btn-primary">
                Manage Drop-Offs
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Expected Drop-off Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingDropoffs as $dropoff)
                        <tr>
                            <td>{{ $dropoff->item_name }} - {{ $dropoff->quantity }} units</td>
                            <td>{{ $dropoff->expected_date?->format('M d, Y') ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-warning">Pending</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.donations.update-status', $dropoff) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-check me-1"></i> Confirm Receipt
                                    </button>
                                </form>
                                <form action="{{ route('admin.donations.update-status', $dropoff) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times me-1"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item i {
    width: 1.25rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('donorSearch');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('table tbody tr').forEach(row => {
            const donorName = row.querySelector('td:first-child').textContent.toLowerCase();
            const donorEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = donorName.includes(searchTerm) || donorEmail.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter functionality
    document.querySelectorAll('[data-filter]').forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            const filterValue = this.dataset.filter;
            document.querySelectorAll('table tbody tr').forEach(row => {
                if (filterValue === 'all') {
                    row.style.display = '';
                    return;
                }
                const type = row.querySelector('td:nth-child(3) .badge').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(5) .badge').textContent.toLowerCase();
                row.style.display = (type === filterValue || status === filterValue) ? '' : 'none';
            });
        });
    });
});
</script>
@endpush
@endsection 