@extends('components.admin-layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create Campaign</h1>
            <p class="text-sm text-gray-600">Create a new fundraising campaign</p>
        </div>
        <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4B5A]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Campaigns
        </a>
    </div>

    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('admin.campaigns.index') }}" class="hover:text-[#1B4B5A]">Campaigns</a></li>
            <li>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </li>
            <li class="text-gray-700">Create New Campaign</li>
        </ol>
    </nav>

    @if($categories->isEmpty())
        <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
            No categories found. <a href="{{ route('admin.categories.index') }}" class="underline text-blue-700">Manage categories</a> to create one first.
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Campaign Image</label>
                    <div class="flex items-center">
                        <div class="w-full">
                            <label class="block">
                                <span class="sr-only">Choose campaign image</span>
                                <input type="file" id="image" name="image" accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#1B4B5A] file:text-white hover:file:bg-[#2C5F6E]"/>
                            </label>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Campaign Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50"/>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Select Category</label>
                    <select id="category_id" name="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>Paused</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Goal Amount -->
                    <div>
                        <label for="goal_amount" class="block text-sm font-medium text-gray-700 mb-2">Goal Amount (PHP)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">₱</span>
                            </div>
                            <input type="number" id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}" required
                                   placeholder="e.g. 50000"
                                   class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50"/>
                        </div>
                        @error('goal_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Initial Funds -->
                    <div>
                        <label for="funds_raised" class="block text-sm font-medium text-gray-700 mb-2">Initial Funds (PHP)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">₱</span>
                            </div>
                            <input type="number" id="funds_raised" name="funds_raised" value="{{ old('funds_raised', 0) }}" required
                                   class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50"/>
                        </div>
                        @error('funds_raised')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50"/>
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50"/>
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('admin.campaigns.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4B5A]">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm text-white bg-[#1B4B5A] hover:bg-[#2C5F6E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4B5A]">
                        Save Campaign
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection