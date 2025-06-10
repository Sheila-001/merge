<x-mail::message>
    <table width="100%" cellpadding="0" cellspacing="0" style="text-align:center;">
    <tr>
        <td>
            <img src="{{ asset('public/image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" width="100" style="margin-bottom: 20px;">
        </td>
    </tr>
</table>
# Monetary Donation Received

<p>Dear {{ $donor_name ?? 'Donor' }},</p>

<p>Thank you for your generous monetary donation. We have successfully received it.</p>

<p>Here are the details of your donation:</p>

<ul>
    <li><strong>Donor Name:</strong> {{ $donor_name ?? 'N/A' }}</li>
    <li><strong>Amount:</strong> ₱{{ number_format($donation_amount ?? 0, 2) }}</li>
    <li><strong>Date:</strong> {{ $donation_date ?? 'N/A' }}</li>
</ul>

<p>Your support makes a significant difference!</p>

Thanks,<br>
<strong>Hauz Hayag</strong><br>
hauzhayag143@gmail.com<br>
(032) 384 6594

<x-slot:footer>
    <div style="text-align:center; color:#888; font-size:12px; margin-top:20px;">
        © 2025 Hauz Hayag Scholarship. All rights reserved.
    </div>
</x-slot:footer>
</x-mail::message>
