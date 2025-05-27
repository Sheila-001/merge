@extends('layouts.app')

@section('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    .fc-event {
        cursor: pointer;
    }
    .fc-event-title {
        font-weight: 500;
    }
    .fc-event-description {
        font-size: 0.85em;
        margin-top: 2px;
    }
    .fc-event-pledged {
        font-size: 0.85em;
        font-weight: 500;
        margin-top: 2px;
    }
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Campaign Calendar</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCampaignModal">
                        <i class="fas fa-plus me-2"></i>Add Campaign
                    </button>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Campaign Modal -->
<div class="modal fade" id="createCampaignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createCampaignForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pledged_amount" class="form-label">Pledged Amount (₱)</label>
                        <input type="number" step="0.01" class="form-control" id="pledged_amount" name="pledged_amount">
                    </div>
                    <div class="mb-3">
                        <label for="pledged_quantity" class="form-label">Pledged Quantity (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="pledged_quantity" name="pledged_quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Campaign</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Campaign Modal -->
<div class="modal fade" id="viewCampaignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Campaign Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <p id="view-title"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <p id="view-description"></p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Start Date</label>
                        <p id="view-start-date"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">End Date</label>
                        <p id="view-end-date"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Category</label>
                    <p id="view-category"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Pledged</label>
                    <p id="view-pledged"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <p id="view-status"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteCampaignBtn">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: @json($campaigns),
        eventClick: function(info) {
            showCampaignDetails(info.event);
        },
        eventDidMount: function(info) {
            // Add tooltip with campaign details
            const event = info.event;
            const tooltip = `
                <strong>${event.title}</strong><br>
                ${event.extendedProps.description || ''}<br>
                ${event.extendedProps.pledged ? `Pledged: ${event.extendedProps.pledged}` : ''}
            `;
            info.el.title = tooltip;
        },
        editable: true,
        eventDrop: function(info) {
            updateCampaignDates(info.event);
        }
    });
    calendar.render();

    // Create Campaign Form Submission
    document.getElementById('createCampaignForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('{{ route("admin.calendar.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(data => {
            calendar.addEvent(data);
            bootstrap.Modal.getInstance(document.getElementById('createCampaignModal')).hide();
            this.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while creating the campaign.');
        });
    });

    // Show Campaign Details
    function showCampaignDetails(event) {
        document.getElementById('view-title').textContent = event.title;
        document.getElementById('view-description').textContent = event.extendedProps.description || 'No description';
        document.getElementById('view-start-date').textContent = event.start.toLocaleDateString();
        document.getElementById('view-end-date').textContent = event.end.toLocaleDateString();
        document.getElementById('view-category').textContent = event.extendedProps.category;
        document.getElementById('view-pledged').textContent = event.extendedProps.pledged || 'Not specified';
        document.getElementById('view-status').textContent = event.extendedProps.status;

        // Set up delete button
        const deleteBtn = document.getElementById('deleteCampaignBtn');
        deleteBtn.onclick = function() {
            if (confirm('Are you sure you want to delete this campaign?')) {
                deleteCampaign(event.id);
            }
        };

        new bootstrap.Modal(document.getElementById('viewCampaignModal')).show();
    }

    // Update Campaign Dates
    function updateCampaignDates(event) {
        fetch(`{{ url('admin/calendar') }}/${event.id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                start_date: event.start.toISOString().split('T')[0],
                end_date: event.end.toISOString().split('T')[0]
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Campaign dates updated successfully');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the campaign dates.');
            calendar.refetchEvents();
        });
    }

    // Delete Campaign
    function deleteCampaign(campaignId) {
        fetch(`{{ url('admin/calendar') }}/${campaignId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            calendar.getEventById(campaignId).remove();
            bootstrap.Modal.getInstance(document.getElementById('viewCampaignModal')).hide();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the campaign.');
        });
    }
});
</script>
@endpush 