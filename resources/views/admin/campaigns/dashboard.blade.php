<x-app-layout>

<div class="container-fluid px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold mb-0">Campaign Dashboard</h1>
            <p class="text-gray-600">Overview of your campaign performance</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.campaigns.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>New Campaign
            </a>
            <a href="{{ route('admin.campaigns.index') }}" class="border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-600 hover:text-white transition">
                <i class="fas fa-list mr-2"></i>Manage Campaigns
            </a>
        </div>
    </div>

    <!-- Campaign Statistics -->
    <div class="grid grid-cols-1 md::grid-cols-4 gap-4 mb-4">
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-blue-100 p-3">
                                <i class="fas fa-bullhorn text-blue-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Active Campaigns</h6>
                            <h4 class="text-xl font-semibold mb-0">{{ $campaigns->where('is_active', true)->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-green-100 p-3">
                                <i class="fas fa-hand-holding-heart text-green-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Donations</h6>
                            <h4 class="text-xl font-semibold mb-0">{{ $recentDonations->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-cyan-100 p-3">
                                <i class="fas fa-chart-line text-cyan-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Raised</h6>
                            <h4 class="text-xl font-semibold mb-0">₱{{ number_format($campaigns->sum('donations_sum_amount'), 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="rounded-full bg-yellow-100 p-3">
                                <i class="fas fa-users text-yellow-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-gray-600 mb-1">Total Donors</h6>
                            <h4 class="text-xl font-semibold mb-0">{{ $recentDonations->unique('donor_email')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Campaigns -->
    <h5 class="text-lg font-semibold mb-4">Active Campaigns</h5>
    <div class="grid grid-cols-1 md::grid-cols-3 gap-4 mb-4">
        @foreach($campaigns->where('is_active', true) as $campaign)
        <div class="">
            <div class="bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="p-4 flex-grow">
                    <div class="flex justify-between items-center mb-3">
                        <h5 class="text-lg font-semibold mb-0">{{ $campaign->title }}</h5>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-{{ $campaign->is_active ? 'green' : 'yellow' }}-500 text-white">
                            {{ $campaign->is_active ? 'Active' : 'Paused' }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($campaign->description, 100) }}</p>
                    <div class="mb-3">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-gray-600 text-sm">Progress</span>
                            <span class="text-gray-600 text-sm">{{ round(($campaign->donations_sum_amount / $campaign->goal_amount) * 100) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full"
                                 style="width: {{ ($campaign->donations_sum_amount / $campaign->goal_amount) * 100 }}%">
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-gray-600 text-sm">₱{{ number_format($campaign->donations_sum_amount, 2) }}</span>
                            <span class="text-gray-600 text-sm">₱{{ number_format($campaign->goal_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.campaigns.show', $campaign) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Recent Donations -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b flex justify-between items-center">
            <h5 class="text-lg font-semibold mb-0">Recent Donations</h5>
            <a href="{{ route('admin.donations.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View All
            </a>
        </div>
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentDonations as $donation)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-500"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $donation->donor_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $donation->donor_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $donation->campaign ? $donation->campaign->title : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">₱{{ number_format($donation->amount, 2) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $donation->created_at->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $donation->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $donation->status === 'completed' ? 'green' : 'yellow' }}-100 text-{{ $donation->status === 'completed' ? 'green' : 'yellow' }}-800">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No recent donations found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</x-app-layout>