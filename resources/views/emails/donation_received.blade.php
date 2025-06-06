<!DOCTYPE html>
<html>
<head>
    <title>Donation Received</title>
</head>
<body>
    <h1>Thank You for Your Donation!</h1>
    <p>Dear {{ $donor_name ?? 'Donor' }},</p>
    <p>Thank you for your generous donation. We have successfully received it.</p>
    <p>Here are the details of your donation:</p>
    <ul>
        @if($donation_type === 'monetary')
            <li><strong>Type:</strong> Monetary</li>
            <li><strong>Amount:</strong> ₱{{ number_format($donation_amount ?? 0, 2) }}</li>
            {{-- Add other monetary details if available, e.g., payment method --}}
        @else
            <li><strong>Type:</strong> Non-monetary</li>
            <li><strong>Item:</strong> {{ $item_name ?? 'N/A' }}</li>
            {{-- Add other non-monetary details if available, e.g., condition, category --}}
        @endif
        <li><strong>Date:</strong> {{ $donation_date ?? 'N/A' }}</li>
        {{-- Add other relevant donation details --}}
    </ul>
    <p>Your support makes a significant difference!</p>
    <p>Sincerely,</p>
    <p>The [Your Organization Name] Team</p>
</body>
</html> 