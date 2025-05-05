@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-12 w-auto rounded-lg">
                    <h1 class="ml-4 text-2xl font-bold text-gray-900">Hauz Hayag</h1>
                </div>
                <a href="/student/dashboard" class="text-primary hover:text-opacity-90">Back to Dashboard</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Scholarship Application Form</h2>
                
                <form action="{{ route('scholarship.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" id="full_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID</label>
                                <input type="text" name="student_id" id="student_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="phone_number" id="phone_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Academic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="gpa" class="block text-sm font-medium text-gray-700">Current GPA</label>
                                <input type="number" name="gpa" id="gpa" step="0.01" min="0" max="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label for="major" class="block text-sm font-medium text-gray-700">Major</label>
                                <input type="text" name="major" id="major" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                            <div>
                                <label for="year_level" class="block text-sm font-medium text-gray-700">Year Level</label>
                                <select name="year_level" id="year_level" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <div>
                                <label for="expected_graduation" class="block text-sm font-medium text-gray-700">Expected Graduation</label>
                                <input type="month" name="expected_graduation" id="expected_graduation" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    <!-- Scholarship Selection -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Scholarship Details</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="scholarship_type" class="block text-sm font-medium text-gray-700">Select Scholarship</label>
                                <select name="scholarship_type" id="scholarship_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="Merit Scholarship">Merit Scholarship</option>
                                    <option value="Research Grant">Research Grant</option>
                                    <option value="Leadership Scholarship">Leadership Scholarship</option>
                                    <option value="STEM Excellence Award">STEM Excellence Award</option>
                                </select>
                            </div>
                            <div>
                                <label for="why_deserve" class="block text-sm font-medium text-gray-700">Why do you deserve this scholarship?</label>
                                <textarea name="why_deserve" id="why_deserve" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                            </div>
                            <div>
                                <label for="career_goals" class="block text-sm font-medium text-gray-700">What are your career goals?</label>
                                <textarea name="career_goals" id="career_goals" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Upload -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Required Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="transcript" class="block text-sm font-medium text-gray-700">Transcript of Records</label>
                                <input type="file" name="transcript" id="transcript" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-opacity-90">
                            </div>
                            <div>
                                <label for="recommendation_letter" class="block text-sm font-medium text-gray-700">Recommendation Letter</label>
                                <input type="file" name="recommendation_letter" id="recommendation_letter" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-opacity-90">
                            </div>
                            <div>
                                <label for="resume" class="block text-sm font-medium text-gray-700">Resume/CV</label>
                                <input type="file" name="resume" id="resume" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-opacity-90">
                            </div>
                            <div>
                                <label for="additional_documents" class="block text-sm font-medium text-gray-700">Additional Documents</label>
                                <input type="file" name="additional_documents" id="additional_documents" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-opacity-90">
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                            </div>
                            <div class="ml-3 text-sm">
                                <label class="font-medium text-gray-700">I certify that all information provided is true and accurate</label>
                                <p class="text-gray-500">I understand that providing false information may result in the rejection of my application or revocation of any scholarship awarded.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-md hover:bg-opacity-90 transition-colors">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection 