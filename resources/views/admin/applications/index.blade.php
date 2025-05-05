@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Scholarship Applications</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($applications as $application)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->tracking_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->course }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $application->status === 'declined' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <select 
                                class="status-select border rounded px-2 py-1"
                                data-application-id="{{ $application->id }}"
                                onchange="updateStatus(this, '{{ $application->id }}')"
                            >
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approve</option>
                                <option value="declined" {{ $application->status === 'declined' ? 'selected' : '' }}>Decline</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateStatus(selectElement, applicationId) {
    const status = selectElement.value;
    fetch(`/admin/applications/${applicationId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        // Refresh the page or update the UI as needed
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status');
    });
}
</script>
@endpush
@endsection