<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="flex flex-col items-center">
                <img class="mx-auto h-16 w-auto rounded-lg shadow-md" src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create New User</h2>
                <p class="mt-2 text-center text-sm text-gray-600">Fill in the details to add a new user</p>
            </div>
            <div class="bg-white py-8 px-6 shadow rounded-lg">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="volunteer" {{ old('role') === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="class_year" class="block text-sm font-medium text-gray-700">Class Year</label>
                        <select name="class_year" id="class_year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="">Select Class Year</option>
                            <option value="2025" {{ old('class_year') === '2025' ? 'selected' : '' }}>Class of 2025</option>
                            <option value="2026" {{ old('class_year') === '2026' ? 'selected' : '' }}>Class of 2026</option>
                        </select>
                        @error('class_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('users.index') }}" class="text-primary hover:underline">Cancel</a>
                        <button type="submit" class="ml-3 px-6 py-2 bg-primary text-primary rounded-md font-semibold hover:bg-secondary transition">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>