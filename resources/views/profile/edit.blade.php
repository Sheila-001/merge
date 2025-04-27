<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Profile Information
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Update your account's profile information and profile picture.
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="mt-4">
                                <div class="flex items-center">
                                    @if(auth()->user()->profile_picture)
                                        <div class="relative">
                                            <img src="{{ Storage::url(auth()->user()->profile_picture) }}" 
                                                 alt="Profile Picture" 
                                                 class="w-20 h-20 rounded-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500 text-xl">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="profile_picture" value="Profile Picture" />
                                    <input type="file" 
                                           id="profile_picture" 
                                           name="profile_picture" 
                                           class="mt-1 block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-full file:border-0
                                                  file:text-sm file:font-semibold
                                                  file:bg-blue-50 file:text-blue-700
                                                  hover:file:bg-blue-100"
                                           accept="image/*">
                                    <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 