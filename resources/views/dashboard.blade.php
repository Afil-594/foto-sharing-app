<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome, {{ Auth::user()->name }} ({{ Auth::user()->role }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user()->role === 'admin')
                        <p class="text-lg font-semibold text-blue-600">Admin Dashboard</p>
                        <a href="{{ route('admin.only') }}" class="text-blue-600 hover:underline">Manage Users</a>
                    @else
                        <p class="text-lg font-semibold text-blue-600">User Dashboard</p>
                        <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile</a>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-blue-600">Your Photos (Placeholder)</h3>
                            <p class="text-gray-600">No photos yet. Upload coming soon!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>