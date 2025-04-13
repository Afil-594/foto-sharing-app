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
                        <p>Admin Dashboard</p>
                        <a href="{{ route('admin.users.index') }}" class="text-blue-600">Manage Users</a>
                    @else
                        <p>User Dashboard</p>
                        <a href="{{ route('profile.edit') }}" class="text-blue-600">Edit Profile</a>
                        <div class="mt-4">
                            <a href="{{ route('photos.index') }}" class="text-blue-600">View Your Photos</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>