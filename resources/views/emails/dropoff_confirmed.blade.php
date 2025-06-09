<x-mail::message>
# Non-Monetary Donation Drop-off Confirmed

<p>Dear {{ $donor_name ?? 'Donor' }},</p>

<p>Thank you for your non-monetary donation. Your drop-off has been confirmed.</p>

<p>We are available to receive your donation on the scheduled date and time:</p>

<p><strong>Expected Drop-off Date & Time:</strong> {{ $expected_date ?? 'N/A' }}</p>

<p>Please ensure the item(s) match the details you provided.</p>

<p>Thank you for your generosity!</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>