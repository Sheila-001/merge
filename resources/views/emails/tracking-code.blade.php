<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Scholarship Application Tracking Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4338ca;
            margin: 0;
        }
        .tracking-code {
            background-color: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #4338ca;
            font-size: 24px;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Scholarship Application</h1>
        </div>
        
        <p>Dear {{ $application->full_name }},</p>
        
        <p>Thank you for submitting your scholarship application. We have received your information and it is currently being reviewed by our team.</p>
        
        <p><strong>Your application tracking code is:</strong></p>
        
        <div class="tracking-code">{{ $application->tracking_code }}</div>
        
        <p>You can use this code to check the status of your application at any time by visiting our website and entering this code in the tracking form.</p>
        
        <p>Current application status: <strong>{{ ucfirst($application->status) }}</strong></p>
        
        <p>We appreciate your interest in our scholarship program and will notify you of any updates to your application status.</p>
        
        <p>Best regards,<br>
        The Scholarship Team</p>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
