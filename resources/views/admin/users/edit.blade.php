<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="flex flex-col items-center">
                <img class="mx-auto h-16 w-auto rounded-lg shadow-md" src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Edit User</h2>
                <p class="mt-2 text-center text-sm text-gray-600">Update the user details below</p>
            </div>
            <div class="bg-white py-8 px-6 shadow rounded-lg">
                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" placeholder="Leave blank to keep current password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="volunteer" {{ $user->role === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Class Year</label>
                        <select name="class_year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="">Select Class Year</option>
                            <option value="2025" {{ $user->class_year === '2025' ? 'selected' : '' }}>Class of 2025</option>
                            <option value="2026" {{ $user->class_year === '2026' ? 'selected' : '' }}>Class of 2026</option>
                        </select>
                    </div>
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('users.index') }}" class="text-primary hover:underline">Cancel</a>
                        <button type="submit" class="ml-3 px-6 py-2 bg-primary text-black rounded-md font-semibold hover:bg-secondary transition">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 