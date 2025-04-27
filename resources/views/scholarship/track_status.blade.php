<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status - Hauz Hayag</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A4B8',
                        secondary: '#FFB800',
                        neutral: '#F3F4F6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-neutral font-sans">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-primary">
                    Application Status
                </h2>
            </div>
            <div class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Tracking Code:</p>
                        <p class="text-lg font-semibold text-gray-900 uppercase tracking-wider">{{ $application->tracking_code }}</p>
                    </div>
                    <div class="pt-4">
                        <p class="text-sm font-medium text-gray-700">Applicant Name:</p>
                        <p class="text-lg text-gray-900">{{ $application->full_name }}</p>
                    </div>
                    <div class="pt-4">
                        <p class="text-sm font-medium text-gray-700">Email:</p>
                        <p class="text-lg text-gray-900">{{ $application->email }}</p>
                    </div>
                     <div class="pt-4">
                        <p class="text-sm font-medium text-gray-700">Scholarship Type:</p>
                        <p class="text-lg text-gray-900">{{ ucwords(str_replace('_', ' ', $application->scholarship_type)) }}</p>
                    </div>
                    <div class="pt-4">
                        <p class="text-sm font-medium text-gray-700">Application Date:</p>
                        <p class="text-lg text-gray-900">{{ $application->created_at->format('F d, Y H:i') }}</p>
                    </div>
                    <div class="pt-6">
                        <p class="text-sm font-medium text-gray-700">Current Status:</p>
                         @php
                            $status = $application->status ?? 'pending';
                            $color = 'yellow'; // Default for pending
                            if (strtolower($status) === 'approved' || strtolower($status) === 'accepted') $color = 'green';
                            if (strtolower($status) === 'rejected' || strtolower($status) === 'declined') $color = 'red';
                        @endphp
                        <span class="px-4 py-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="/" {{-- Or use route('home') if defined --}} class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-primary bg-primary/10 hover:bg-primary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 