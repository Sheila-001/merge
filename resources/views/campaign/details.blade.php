<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white; /* White background */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .campaign-details-container {
            max-width: 500px;
            width: 100%;
            background-color: #f3f4f6; /* A light gray background for the content box */
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .progress-bar-container {
            height: 8px;
            background-color: #bfdbfe; /* Tailwind blue-200 */
            border-radius: 9999px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .progress-bar {
            height: 100%;
            background-color: #0a90a4; /* Your theme color */
            border-radius: 9999px;
        }
        .impact-section {
            background-color: #4b5563; /* Tailwind gray-700 */
            color: #d1d5db; /* Tailwind gray-300 */
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="campaign-details-container">
        <h2 id="campaignTitle" class="text-2xl font-bold text-center mb-4"></h2>
        <p id="campaignFrequency" class="text-sm text-center mb-4"></p>

        <div class="mb-4">
            <div class="flex justify-between text-sm mb-1">
                <span>Campaign Progress</span>
                <span id="campaignPercentage"></span>
            </div>
            <div class="progress-bar-container">
                <div id="campaignProgressBar" class="progress-bar" style="width: 0;"></div>
            </div>
            <div class="flex justify-between text-sm mt-1">
                <span id="campaignRaised"></span>
                <span id="campaignGoal"></span>
            </div>
        </div>

        <div class="impact-section">
            <p class="text-sm font-semibold mb-2">Impact</p>
            <p id="campaignImpact" class="text-sm"></p>
        </div>

        <a href="{{ route('monetary_donation') }}" class="block w-full bg-[#0A90A4] text-white text-center py-3 rounded-lg hover:bg-[#098a9d] transition-colors font-medium">Donate Now</a>

        <button onclick="window.history.back()" class="block w-full bg-gray-500 text-white text-center py-3 rounded-lg hover:bg-gray-600 transition-colors font-medium mt-4">Back to Calendar</button>

    </div>

    <script>
        // Function to parse query parameters
        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const regex = /([^&=]+)=([^&]*)/g;
            let m;
            while (m = regex.exec(queryString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return params;
        }

        // Get campaign data from URL
        const campaignData = getQueryParams();

        // Populate the details on the page
        document.getElementById('campaignTitle').innerText = campaignData.title || 'Campaign Title';
        document.getElementById('campaignFrequency').innerText = campaignData.frequency || '';
        document.getElementById('campaignRaised').innerText = (campaignData.raised || '0') + ' raised';
        document.getElementById('campaignGoal').innerText = 'Goal: ' + (campaignData.goal || 'N/A');
        const percentage = parseInt(campaignData.percentage) || 0;
        document.getElementById('campaignProgressBar').style.width = percentage + '%';
        document.getElementById('campaignPercentage').innerText = percentage + '%';
        document.getElementById('campaignImpact').innerText = campaignData.impact || 'No impact description available.';

    </script>
</body>
</html> 