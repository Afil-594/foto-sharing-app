<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile: {{ $user->username }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center mb-6">
                        @if ($user->profile_photo)
                            <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile Photo" class="w-[3rem] h-[3rem] rounded-full mr-4">
                        @else
                            <div class="w-[3rem] h-[3rem] rounded-full bg-gray-300 mr-4 flex items-center justify-center">
                                <span class="text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->username }}</p>
                        </div>
                    </div>

                    @if ($isOwnProfile)
                        <div class="mb-6">
                            <a href="{{ route('profile.edit') }}" class="text-blue-600">Edit Profile</a>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-md font-semibold">Update Profile Photo</h4>
                            @if (session('success'))
                                <p class="text-green-600">{{ session('success') }}</p>
                            @endif
                            <form method="POST" action="{{ route('photo.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="profile_photo" class="block text-sm font-medium text-gray-700">Choose Photo</label>
                                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1 block w-full">
                                    @error('profile_photo')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="custom-button">Update Photo</button>
                            </form>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-md font-semibold">Upload New Photo</h4>
                            <form method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="photo" class="block text-sm font-medium text-gray-700">Choose Photo</label>
                                    <input type="file" name="photo" id="photo" class="mt-1 block w-full">
                                    @error('photo')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="custom-button">Upload Photo</button>
                            </form>
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mt-6">Photos</h3>
                    @if ($photos->isEmpty())
                        <p>No photos yet.</p>
                    @else
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            @foreach ($photos as $photo)
                                <div>
                                    <img src="{{ Storage::url($photo->url) }}" alt="Photo" class="w-[5rem] h-[5rem] object-cover">
                                    @if ($isOwnProfile)
                                        <form action="{{ route('photo.destroy', $photo) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="custom-delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>