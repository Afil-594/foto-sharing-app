<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Photos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Upload a Photo</h3>
                    <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input type="file" name="photo" class="mt-1 block w-full">
                            @error('photo')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
                    </form>

                    <h3 class="text-lg font-semibold mt-6">Your Gallery</h3>
                    @if (session('success'))
                        <p class="text-green-600">{{ session('success') }}</p>
                    @endif
                    @if ($photos->isEmpty())
                        <p>No photos yet.</p>
                    @else
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            @foreach ($photos as $photo)
                                <div>
                                    <img src="{{ Storage::url($photo->url) }}" alt="Photo" class="w-full h-32 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>