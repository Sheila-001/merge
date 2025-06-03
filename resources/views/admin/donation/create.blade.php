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
                <div class="card-header">
                    <h5 class="card-title mb-0">Add New Donation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donations.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="donor_name" class="form-label">Donor Name</label>
                                <input type="text" class="form-control @error('donor_name') is-invalid @enderror" 
                                    id="donor_name" name="donor_name" value="{{ old('donor_name') }}" required>
                                @error('donor_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="donor_email" class="form-label">Donor Email</label>
                                <input type="email" class="form-control @error('donor_email') is-invalid @enderror" 
                                    id="donor_email" name="donor_email" value="{{ old('donor_email') }}" required>
                                @error('donor_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Donation Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="monetary" {{ old('type') == 'monetary' ? 'selected' : '' }}>Monetary</option>
                                    <option value="non-monetary" {{ old('type') == 'non-monetary' ? 'selected' : '' }}>Non-Monetary</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="amountField" style="display: none;">
                                <label for="amount" class="form-label">Amount (₱)</label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                    id="amount" name="amount" value="{{ old('amount') }}">
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="itemNameField" style="display: none;">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" class="form-control @error('item_name') is-invalid @enderror" 
                                    id="item_name" name="item_name" value="{{ old('item_name') }}">
                                @error('item_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="quantityField" style="display: none;">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                    id="quantity" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="expectedDateField" style="display: none;">
                                <label for="expected_date" class="form-label">Expected Drop-off Date</label>
                                <input type="date" class="form-control @error('expected_date') is-invalid @enderror" 
                                    id="expected_date" name="expected_date" value="{{ old('expected_date') }}">
                                @error('expected_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Donation</button>
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const amountField = document.getElementById('amountField');
    const itemNameField = document.getElementById('itemNameField');
    const quantityField = document.getElementById('quantityField');
    const expectedDateField = document.getElementById('expectedDateField');

    function toggleFields() {
        const selectedType = typeSelect.value;
        
        if (selectedType === 'monetary') {
            amountField.style.display = 'block';
            itemNameField.style.display = 'none';
            quantityField.style.display = 'none';
            expectedDateField.style.display = 'none';
        } else if (selectedType === 'non-monetary') {
            amountField.style.display = 'none';
            itemNameField.style.display = 'block';
            quantityField.style.display = 'block';
            expectedDateField.style.display = 'block';
        } else {
            amountField.style.display = 'none';
            itemNameField.style.display = 'none';
            quantityField.style.display = 'none';
            expectedDateField.style.display = 'none';
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    toggleFields(); // Initial state
});
</script>
@endpush
@endsection 