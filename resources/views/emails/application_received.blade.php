<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 8px; }
        .code { background-color: #f4f4f4; padding: 10px 15px; border-radius: 4px; font-size: 1.1em; font-weight: bold; display: inline-block; margin-top: 10px; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dear {{ $applicantName }},</h2>
        
        <p>Thank you for submitting your scholarship application to Hauz Hayag!</p>
        
        <p>We have received your application and it is now being processed. Your unique tracking code is:</p>
        
        <div class="code">{{ $trackingCode }}</div>
        
        <p>You can use this code on our website to check the status of your application at any time.</p>
        
        <p>We appreciate your interest and will be in touch regarding the next steps.</p>
        
        <p>Sincerely,<br>The Hauz Hayag Team</p>
        
        <div class="footer">
            <p>Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html> 