<x-guest-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Welcome to Photo Sharing</h1>
        <p class="mt-4 text-gray-600">
            Share your moments with the world! <br>
            @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-semibold">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login</a> |
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Register</a>
            @endif
        </p>
    </div>
</x-guest-layout>