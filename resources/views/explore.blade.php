<!-- resources/views/explore.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 1000; font-size: 1.25rem; color:#3e4648; line-height: 1.25; ">
                FOTOKU
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
        }
        .card {
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(255, 255, 255, 0);
            border-radius: 0.5rem;
        }
        .card-content {
            padding: 1.5rem;
            color: #111827;
        }
        .user-container {
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
            background-color: #fff;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e5e5;
            margin-right: 0.75rem;
        }
        .profile-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            border: 2px solid #e5e5e5;
        }
        .profile-placeholder span {
            color: #4b5563;
            font-size: 1rem;
        }
        .profile-info a {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            text-decoration: none;
        }
        .profile-info a:hover {
            color: #2563eb;
        }
        .profile-info p {
            color: #4b5563;
            font-size: 0.875rem;
            margin: 0;
        }
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(1, 500px);
            gap: 8px;
            justify-content: center;
        }
        .photo-item {
            width: 500px;
            height: 500px;
            object-fit: cover;
            border: 2px solidrgb(255, 255, 255);
        }
        .no-photos {
            color: #4b5563;
        }
        .no-users {
            color: #4b5563;
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-content">
                @forelse ($users as $user)
                    <div class="user-container">
                        <!-- Header Profil per User -->
                        <div class="profile-header">
                            @if ($user->profile_photo)
                                <img src="{{ Storage::url($user->profile_photo) }}" alt="Foto Profil" class="profile-pic">
                            @else
                                <div class="profile-placeholder">
                                    <span>{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="profile-info">
                                <a href="{{ route('profile.show', $user->username) }}">{{ $user->name }}</a>
                                <p>{{ $user->username }}</p>
                            </div>
                        </div>

                        <!-- Grid Foto per User -->
                        @if ($user->photos->isEmpty())
                            <p class="no-photos">Belum ada foto.</p>
                        @else
                            <div class="photo-grid">
                                @foreach ($user->photos->take(1) as $photo)
                                    <div class="relative">
                                        <img src="{{ Storage::url($photo->url) }}" alt="Foto" class="photo-item">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="no-users">Tidak ada pengguna yang ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>