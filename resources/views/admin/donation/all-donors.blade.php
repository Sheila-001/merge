@extends('layouts.app')

@section('content')
<div class="p-8 bg-[#f3f6fb] min-h-screen">
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold">All Donations </h1>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600">Admin</span>
            <div class="bg-blue-200 text-blue-700 rounded-full px-3 py-1 font-semibold">AD</div>
        </div>
    </div>

    <!-- All Donations Table -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-lg">All Donations</h2>
            {{-- Removed search input --}}
            <div>{{-- Empty div for spacing --}}</div>
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
                            <img src="{{ Storage::url($donation->proof_path) }}" alt="Donation Proof" class="w-10 h-10 object-cover rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2">
                        <div class="flex space-x-2">
                             <a href="{{ route('admin.donations.show', $donation) }}" class="text-green-800 bg-green-100 px-2 py-1 rounded hover:bg-green-200"><i class="fas fa-eye"></i> View</a>
                             <a href="{{ route('admin.donations.edit', $donation) }}" class="text-green-600 hover:text-green-800"><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Removed pagination links --}}
    </div>

    {{-- Removed Drop-Off Confirmation section --}}

</div>

<!-- Proof Image Modal -->
<div id="proofModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 max-w-lg max-h-full overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h3 class="text-lg font-semibold">Donation Proof</h3>
            <button id="closeProofModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <img id="proofImage" src="" alt="Donation Proof" class="max-w-full h-auto">
    </div>
</div>
@endsection

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
    // Proof image modal functionality (keeping this as it's useful for viewing proofs)
    const proofModal = document.getElementById('proofModal');
    const proofImage = document.getElementById('proofImage');
    const closeProofModal = document.getElementById('closeProofModal');
    const viewProofLinks = document.querySelectorAll('.view-proof-link');

    viewProofLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const imageUrl = this.dataset.proofUrl;
            proofImage.src = imageUrl;
            proofModal.classList.remove('hidden');
        });
    });

    closeProofModal.addEventListener('click', function() {
        proofModal.classList.add('hidden');
        proofImage.src = ''; // Clear the image source when closing
    });

    // Close modal when clicking outside of the modal content
    proofModal.addEventListener('click', function(e) {
        if (e.target === proofModal) {
            proofModal.classList.add('hidden');
            proofImage.src = ''; // Clear the image source when closing
        }
    });
});
</script>
@endpush 