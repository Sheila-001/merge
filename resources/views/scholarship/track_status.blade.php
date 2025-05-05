<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Application Status - Hauz Hayag</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <header class="bg-white shadow fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('image/logohauzhayag.jpg') }}"
                         alt="Hauz Hayag Logo"
                         class="h-16 w-auto rounded-lg shadow-md">
                    <span class="text-2xl font-bold text-primary">Hauz Hayag</span>
                </div>
                <a href="/" class="text-gray-700 hover:text-primary transition flex items-center space-x-2">
                    <i class="fas fa-home"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </header>

    <main class="pt-28 pb-16">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-center text-primary mb-6">Application Status</h1>
                
                <div class="mb-8 flex items-center justify-center">
                    <div class="bg-gray-100 px-4 py-2 rounded-lg text-center">
                        <p class="text-sm text-gray-500">Tracking Code</p>
                        <p class="font-mono text-xl font-bold">{{ $application->tracking_code }}</p>
                    </div>
                </div>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Application Information</h2>
                        
                        @if($application->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                Pending
                            </span>
                        @elseif($application->status == 'approved')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Approved
                            </span>
                        @elseif($application->status == 'declined')
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                Declined
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">Applicant Name</p>
                            <p class="font-medium">{{ $application->full_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Email Address</p>
                            <p class="font-medium">{{ $application->email }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Phone Number</p>
                            <p class="font-medium">{{ $application->phone_number ?? 'Not provided' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Scholarship Type</p>
                            <p class="font-medium">{{ ucfirst(str_replace('_', ' ', $application->scholarship_type)) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Application Date</p>
                            <p class="font-medium">{{ $application->created_at->format('F d, Y') }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Last Updated</p>
                            <p class="font-medium">{{ $application->updated_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="font-semibold text-lg mb-2">Status Timeline</h3>
                    <div class="relative pl-8 ml-4">
                        <div class="absolute top-0 left-0 h-full w-px bg-gray-200"></div>
                        
                        <div class="relative mb-8">
                            <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full bg-green-500 border-2 border-white"></div>
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-xs">{{ $application->created_at->format('M d, Y - h:i A') }}</span>
                                <span class="font-medium">Application Received</span>
                                <p class="text-sm text-gray-600 mt-1">Your application has been successfully submitted.</p>
                            </div>
                        </div>
                        
                        <div class="relative mb-8">
                            <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full {{ $application->status == 'pending' ? 'bg-yellow-500' : ($application->status == 'approved' || $application->status == 'declined' ? 'bg-green-500' : 'bg-gray-300') }} border-2 border-white"></div>
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-xs">{{ $application->updated_at == $application->created_at ? 'In Progress' : $application->updated_at->format('M d, Y - h:i A') }}</span>
                                <span class="font-medium">Application Review</span>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->status == 'pending')
                                        Your application is currently being reviewed by our team.
                                    @elseif($application->status == 'approved' || $application->status == 'declined')
                                        Your application has been reviewed by our team.
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full {{ $application->status == 'approved' ? 'bg-green-500' : ($application->status == 'declined' ? 'bg-red-500' : 'bg-gray-300') }} border-2 border-white"></div>
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-xs">{{ $application->status == 'pending' ? 'Pending' : $application->updated_at->format('M d, Y - h:i A') }}</span>
                                <span class="font-medium">Final Decision</span>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->status == 'pending')
                                        Decision pending. We will notify you via email when the review is complete.
                                    @elseif($application->status == 'approved')
                                        Congratulations! Your scholarship application has been approved. Please check your email for next steps.
                                    @elseif($application->status == 'declined')
                                        We regret to inform you that your application was not selected for the scholarship at this time.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($application->status == 'approved')
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <div class="mr-4 text-green-500">
                            <i class="fas fa-check-circle text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-green-800">Application Approved</h3>
                            <p class="text-green-700 mt-1">Congratulations! You have been selected as a recipient for our scholarship program. An email with detailed instructions has been sent to your registered email address.</p>
                            <p class="text-green-700 mt-4">Please respond within 7 days to confirm your acceptance.</p>
                        </div>
                    </div>
                </div>
                @elseif($application->status == 'declined')
                <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <div class="mr-4 text-red-500">
                            <i class="fas fa-times-circle text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-red-800">Application Not Selected</h3>
                            <p class="text-red-700 mt-1">We appreciate your interest in our scholarship program. Unfortunately, your application was not selected at this time.</p>
                            <p class="text-red-700 mt-4">We encourage you to apply again for future opportunities.</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="text-center">
                    <a href="/" class="inline-flex items-center text-primary hover:text-primary/80">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-[#e6f4ea] text-gray-800 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} Hauz Hayag Scholarship. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>