<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Category</h1>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Categories
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50 @error('name') border-red-500 @enderror" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                        <div class="flex space-x-2">
                            <input type="color" 
                                   name="color" 
                                   id="color" 
                                   class="h-10 w-20 rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50 @error('color') border-red-500 @enderror" 
                                   value="{{ old('color', '#4361ee') }}">
                            <input type="text" 
                                   id="colorText" 
                                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50" 
                                   value="{{ old('color', '#4361ee') }}" 
                                   pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring focus:ring-[#1B4B5A] focus:ring-opacity-50 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-[#1B4B5A] text-white rounded-md hover:bg-[#2C5F6E] transition-colors">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colorInput = document.getElementById('color');
            const colorText = document.getElementById('colorText');

            // Sync color picker with text input
            colorInput.addEventListener('input', function() {
                colorText.value = this.value;
            });

            // Sync text input with color picker
            colorText.addEventListener('input', function() {
                if (this.value.match(/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/)) {
                    colorInput.value = this.value;
                }
            });
        });
    </script>
    @endpush
</x-app-layout> 