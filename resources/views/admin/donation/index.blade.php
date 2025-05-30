@php use Illuminate\Support\Facades\Storage; @endphp
<x-app-layout>
    <div class="p-8 bg-[#f3f6fb] min-h-screen">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Donation </h1>
            <div class="flex items-center space-x-2">
                <span class="text-gray-600">Admin</span>
                <div class="bg-blue-200 text-blue-700 rounded-full px-3 py-1 font-semibold">AD</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow flex flex-col">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-700">Monetary Donations</span>
                    <span class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                </div>
                <span class="mt-4 text-2xl font-bold">{{ $monetaryTotal ?? 0 }}</span>
                <span class="text-xs text-green-500 mt-1">↑12% from last month</span>
            </div>
            <div class="bg-white rounded-xl p-6 shadow flex flex-col">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-700">Non-Monetary Items</span>
                    <span class="bg-purple-100 text-purple-600 p-2 rounded-full">
                        <i class="fas fa-box"></i>
                    </span>
                </div>
                <span class="mt-4 text-2xl font-bold">{{ $nonMonetaryCount ?? 0 }}</span>
                <span class="text-xs text-green-500 mt-1">↑8% from last month</span>
            </div>
            <div class="bg-white rounded-xl p-6 shadow flex flex-col">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-700">Campaign</span>
                    <span class="bg-orange-100 text-orange-600 p-2 rounded-full">
                        <i class="fas fa-bullhorn"></i>
                    </span>
                </div>
                <span class="mt-4 text-2xl font-bold">{{ $campaignTotal ?? 0 }}</span>
                <span class="text-xs text-green-500 mt-1">↑10% from last month</span>
            </div>
            <div class="bg-white rounded-xl p-6 shadow flex flex-col">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-700">Total Donors</span>
                    <span class="bg-green-100 text-green-600 p-2 rounded-full">
                        <i class="fas fa-users"></i>
                    </span>
                </div>
                <span class="mt-4 text-2xl font-bold">{{ $donorCount ?? 0 }}</span>
                <span class="text-xs text-green-500 mt-1">↑13% from last month</span>
            </div>
        </div>

        <!-- Recent Donations Table -->
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-lg">Recent Donations</h2>
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Search donors..." class="border rounded px-3 py-1 text-sm">
                    <button class="bg-blue-600 text-white px-4 py-1 rounded">Filter</button>
                </div>
            </div>
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Donor</th>
                        <th class="py-2 text-left">Type</th>
                        <th class="py-2 text-left">Amount</th>
                        <th class="py-2 text-left">Status</th>
                        <th class="py-2 text-left">Date</th>
                        <th class="py-2 text-left">Proof</th>
                        <th class="py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                    <tr class="border-b">
                        <td class="py-2 flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($donation->donor_name) }}&background=random" class="w-8 h-8 rounded-full" alt="{{ $donation->donor_name }}">
                            <span>
                                <div class="font-semibold">{{ $donation->donor_name }}</div>
                                <div class="text-xs text-gray-500">{{ $donation->donor_email }}</div>
                            </span>
                        </td>
                        <td class="py-2">{{ ucfirst($donation->type) }}</td>
                        <td class="py-2 font-bold">
                            @if($donation->type === 'monetary')
                                ₱{{ number_format($donation->amount, 2) }}
                            @else
                                {{ $donation->item_name }} {{-- Changed from $donation->description --}}
                            @endif
                        </td>
                        <td class="py-2">
                            <span class="bg-{{ $donation->status === 'completed' ? 'green' : 'yellow' }}-100 text-{{ $donation->status === 'completed' ? 'green' : 'yellow' }}-600 px-2 py-1 rounded">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </td>
                        <td class="py-2">{{ $donation->created_at->format('M d, Y') }}</td>
                        <td class="py-2">
                            @if($donation->proof_path)
                                <a href="{{ route('admin.donations.serve-proof', ['filename' => basename($donation->proof_path)]) }}" target="_blank" class="text-blue-600 hover:underline">View Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="py-2">
                            <div class="flex space-x-2">
                                 <a href="{{ route('admin.donations.show', $donation) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></a>
                                 <a href="{{ route('admin.donations.edit', $donation) }}" class="text-green-600 hover:text-green-800"><i class="fas fa-edit"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <div class="flex justify-between items-center mt-4">
                 <span class="text-xs text-gray-500">Showing {{ $donations->firstItem() }} to {{ $donations->lastItem() }} of {{ $donations->total() }} entries</span>
                 <div class="flex space-x-1">
                     {{ $donations->links() }}
                 </div>
             </div>
        </div>

        <!-- Drop-Off Confirmation -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-lg mb-2">Drop-Off Confirmation</h2>
            <p class="text-gray-500 mb-4">Manage and track non-monetary donations</p>
            <div class="bg-blue-50 p-4 rounded-xl mb-2">
                <h3 class="font-semibold mb-1">Pending Drop-offs</h3>
                <div class="space-y-2">
                    @foreach($pendingDropoffs as $dropoff)
                    <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow mb-2">
                        <div class="flex items-center space-x-2">
                            <span class="bg-blue-100 p-2 rounded"><i class="fas fa-box"></i></span>
                            <span>{{ $dropoff->item_name }} - {{ $dropoff->quantity }} units</span> {{-- Changed from $dropoff->description --}}
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-400">Expected: {{ $dropoff->expected_date?->format('M d, Y') ?? 'N/A' }}</span> {{-- Changed from created_at->addDays(7) --}}
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Pending</span>
                             <form action="{{ route('admin.donations.update-status', $dropoff->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="bg-green-100 text-green-600 px-2 py-1 rounded">Received</button>
                            </form>
                             <form action="{{ route('admin.donations.update-status', $dropoff->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                 <button type="submit" class="bg-red-100 text-red-600 px-2 py-1 rounded">Reject</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
    const searchInput = document.querySelector('input[placeholder="Search donors..."]');
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