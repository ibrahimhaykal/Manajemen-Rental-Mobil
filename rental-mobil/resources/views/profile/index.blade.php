<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto grid gap-6 sm:grid-cols-2">
            <div class="p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Update Profile Information</h3>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                        <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password Form -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Update Password</h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account Form -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Delete Account</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
