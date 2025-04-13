<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Explore Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($users as $user)
                        <div class="mb-6">
                            <div class="flex items-center mb-4">
                                @if ($user->profile_photo)
                                    <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile Photo" class="w-[3rem] h-[3rem] rounded-full mr-3">
                                @else
                                    <div class="w-[3rem] h-[3rem] rounded-full bg-gray-300 mr-3 flex items-center justify-center">
                                        <span class="text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('profile.show', $user->username) }}" class="text-lg font-semibold text-blue-600">{{ $user->name }}</a>
                                    <p class="text-gray-600">{{ $user->username }}</p>
                                </div>
                            </div>

                            @if ($user->photos->isEmpty())
                                <p>No photos yet.</p>
                            @else
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($user->photos->take(3) as $photo)
                                       Incorrect: <div>
                                            <img src="{{ Storage::url($photo->url) }}" alt="Photo" class="w-[5rem] h-[5rem] object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p>No users found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>