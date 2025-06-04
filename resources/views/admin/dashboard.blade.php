@php use Illuminate\Support\Facades\Storage; @endphp
<x-app-layout>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Header Row: Title and User Badge -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold">Dashboard Overview</h1>
            <div class="flex items-center gap-2">
                <span class="text-gray-500">Admin</span>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-bold">AD</span>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Monetary Donations</span>
                <span class="text-3xl font-bold mt-2">₱{{ number_format($monetaryTotal, 2) }}</span>
                @if($monetaryChange != 0)
                    <span class="text-sm {{ $monetaryChange > 0 ? 'text-green-500' : 'text-red-500' }} mt-1">
                        {{ $monetaryChange > 0 ? '+' : '' }}{{ number_format($monetaryChange, 1) }}%
                    </span>
                @endif
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Non-Monetary Donations</span>
                <span class="text-3xl font-bold mt-2">{{ $nonMonetaryCount }}</span>
                @if($nonMonetaryChange != 0)
                    <span class="text-sm {{ $nonMonetaryChange > 0 ? 'text-green-500' : 'text-red-500' }} mt-1">
                        {{ $nonMonetaryChange > 0 ? '+' : '' }}{{ number_format($nonMonetaryChange, 1) }}%
                    </span>
                @endif
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Campaign Donations</span>
                <span class="text-3xl font-bold mt-2">₱{{ number_format($campaignTotal, 2) }}</span>
                @if($campaignChange != 0)
                    <span class="text-sm {{ $campaignChange > 0 ? 'text-green-500' : 'text-red-500' }} mt-1">
                        {{ $campaignChange > 0 ? '+' : '' }}{{ number_format($campaignChange, 1) }}%
                    </span>
                @endif
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Total Donors</span>
                <span class="text-3xl font-bold mt-2">{{ $donorCount }}</span>
                @if($donorChange != 0)
                    <span class="text-sm {{ $donorChange > 0 ? 'text-green-500' : 'text-red-500' }} mt-1">
                        {{ $donorChange > 0 ? '+' : '' }}{{ number_format($donorChange, 1) }}%
                    </span>
                @endif
            </div>
        </div>

        <!-- Recent Donations and Pending Drop-offs -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Donations -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Recent Donations</h2>
                    <a href="{{ route('admin.donations.index') }}" class="text-blue-600 hover:underline">View all</a>
                </div>
                @if($donations->count() > 0)
                    <div class="space-y-4">
                        @foreach($donations as $donation)
                            <div class="border-b pb-4 last:border-b-0 last:pb-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $donation->donor_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $donation->type === 'monetary' ? '₱' . number_format($donation->amount, 2) : 'Non-monetary' }}</p>
                                    </div>
                                    <span class="px-2 py-1 rounded text-sm {{ $donation->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ $donation->created_at->format('M d, Y H:i A') }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No recent donations found.</p>
                @endif
            </div>

            <!-- Pending Drop-offs -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Pending Drop-offs</h2>
                    <a href="{{ route('admin.donations.dropoffs') }}" class="text-blue-600 hover:underline">View all</a>
                </div>
                @if($pendingDropoffs->count() > 0)
                    <div class="space-y-4">
                        @foreach($pendingDropoffs as $dropoff)
                            <div class="border-b pb-4 last:border-b-0 last:pb-0">
                                <p class="font-semibold">{{ $dropoff->donor_name }}</p>
                                <p class="text-sm text-gray-500">{{ $dropoff->description }}</p>
                                <p class="text-sm text-gray-500 mt-1">Expected: {{ $dropoff->dropoff_date ? $dropoff->dropoff_date->format('M d, Y') : 'Not specified' }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No pending drop-offs.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>