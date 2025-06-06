<x-app-layout>
    <x-slot name="title">
        Reports
    </x-slot>

    {{-- Add Chart.js library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container-fluid px-4">
    <h1 class="h3 mb-4">Reports</h1>

    <!-- Top Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Monetary Donations</div>
                        <div class="text-xl font-semibold text-gray-800">₱ {{ number_format($monetaryDonationsTotal, 2) }}</div>
                    </div>
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Non-Monetary</div>
                        <div class="text-xl font-semibold text-gray-800">{{ $nonMonetaryDonationsCount }}</div>
                    </div>
                    <i class="fas fa-box-open fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Campaigns</div>
                        <div class="text-xl font-semibold text-gray-800">{{ $campaignsCount }}</div>
                    </div>
                    <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-600 mb-1">Donors</div>
                        <div class="text-xl font-semibold text-gray-800">{{ $donorsCount }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts/Graphs Placeholder -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h6 class="text-lg font-semibold mb-4">Donation Distribution</h6>
            {{-- Bar graph for monthly donations --}}
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="monthlyDonationsChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h6 class="text-lg font-semibold mb-4">Monthly Trends</h6>
            {{-- Placeholder for chart --}}
            <div class="chart-area">
                {{-- Chart will be rendered here --}}
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h6 class="text-lg font-semibold mb-0">Recent Activity</h6>
            {{-- Assuming there might be a link here in the future, keep the flex --}}
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount/Items</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentDonations as $donation)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $donation->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($donation->type) }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($donation->type === 'monetary')
                                ₱{{ number_format($donation->amount, 2) }}
                            @else
                                {{ $donation->item_details }}
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $donation->status === 'completed' ? 'green' : ($donation->status === 'pending' ? 'yellow' : 'gray') }}-100 text-{{ $donation->status === 'completed' ? 'green' : ($donation->status === 'pending' ? 'yellow' : 'gray') }}-800">
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

<script>
    const monthlyLabels = @json($monthlyLabels); // Use data from controller
    const monthlyData = @json($monthlyData);     // Use data from controller

    const ctx = document.getElementById('monthlyDonationsChart').getContext('2d');
    const monthlyDonationsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Donations',
                data: monthlyData,
                backgroundColor: 'orange',
                borderColor: 'darkorange',
                borderWidth: 2,
                tension: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    max: 7000,
                    ticks: {
                        stepSize: 1000
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            elements: {
                point: {
                    radius: 5,
                    backgroundColor: 'orange',
                    borderColor: 'darkorange'
                }
            }
        }
    });

    const monthlyTrendsChartCtx = document.querySelector('.chart-area').appendChild(document.createElement('canvas')).getContext('2d');
    const monthlyTrendsChart = new Chart(monthlyTrendsChartCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Donations',
                data: monthlyData,
                backgroundColor: 'orange',
                borderColor: 'darkorange',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 90,
                    ticks: {
                        stepSize: 10
                    },
                    title: {
                        display: true,
                        text: 'PHP'
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    },
                    grid: {
                        color: 'rgba(255, 165, 0, 0.5)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD',  minimumFractionDigits: 0, maximumFractionDigits: 0  }).format(context.raw * 1000);
                            return label;
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 5,
                    backgroundColor: 'orange',
                    borderColor: 'darkorange'
                }
            }
        }
    });
</script>

{{-- It seems the logout link is part of a layout used by this file. I will add a form here just in case, but the fix might be in the layout file. --}}
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>

{{-- I need to find where the actual logout link is in this file or its layout and attach the form submission to it. Since I don't see the direct link in the portion I read, it's likely in the layout file (<x-app-layout>). I've already modified <x-app-layout>, but there might be other layouts or a hardcoded link I missed. Let's assume for now the layout change covers it and this file itself doesn't have a direct link. --}}

{{-- However, based on the persistent error on this specific page, there might be a logout link *within* this file's content or a different layout. I will re-read the file to be sure. --}}

</x-app-layout> 