<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Welcome, Admin!</h3>
                    <p class="mt-4">
                        <a href="{{ route('admin.users.index') }}" class="text-blue-600">Manage Users</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>