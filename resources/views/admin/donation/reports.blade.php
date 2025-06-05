<x-app-layout>
    <x-slot name="title">
        Reports
    </x-slot>

    <h1 class="h3 mb-4">Reports</h1>

    <!-- Top Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-primary mb-1">Monetary Donations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₱ {{ number_format($monetaryDonationsTotal, 2) }}</div>
                        </div>
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-warning mb-1">Non-Monetary</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nonMonetaryDonationsCount }}</div>
                        </div>
                        <i class="fas fa-box-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-success mb-1">Campaigns</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $campaignsCount }}</div>
                        </div>
                        <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-info mb-1">Donors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $donorsCount }}</div>
                        </div>
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts/Graphs Placeholder -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donation Distribution</h6>
                </div>
                <div class="card-body">
                    {{-- Placeholder for chart --}}
                    <div class="chart-area">
                        {{-- Chart will be rendered here --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Trends</h6>
                </div>
                <div class="card-body">
                    {{-- Placeholder for chart --}}
                    <div class="chart-area">
                        {{-- Chart will be rendered here --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount/Items</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentDonations as $donation)
                        <tr>
                            <td>{{ $donation->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ ucfirst($donation->type) }}</td>
                            <td>
                                @if($donation->type === 'monetary')
                                    ₱{{ number_format($donation->amount, 2) }}
                                @else
                                    {{ $donation->item_details }}
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 