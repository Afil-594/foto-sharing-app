<!-- resources/views/profile/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937; line-height: 1.25;">
            Profil: {{ $user->username }}
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
            background-color: #fff;
        }
        .profile-header {
            padding: 1rem;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }
        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e5e5;
        }
        .profile-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e5e5e5;
        }
        .profile-placeholder span {
            color: #4b5563;
            font-size: 1.25rem;
        }
        .profile-info {
            flex: 1;
        }
        .profile-info h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 0.5rem 0;
        }
        .profile-stats {
            display: flex;
            gap: 1.5rem;
            font-size: 0.875rem;
            color: #111827;
        }
        .profile-stats span {
            font-weight: 600;
        }
        .profile-info p {
            font-size: 0.875rem;
            font-weight: 500;
            color: #111827;
            margin: 0.5rem 0 0 0;
        }
        .edit-button {
            font-size: 0.875rem;
            color: #4b5563;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            padding: 0.25rem 0.75rem;
            text-decoration: none;
        }
        .edit-button:hover {
            background-color: #f3f4f6;
        }
        .form-section {
            padding: 1rem;
            border-bottom: 1px solid #e5e5e5;
        }
        .form-section h4 {
            font-size: 0.875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.5rem;
        }
        .success-message {
            color: #16a34a;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        .form-section form {
            margin-bottom: 1.5rem;
        }
        .form-section label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.25rem;
        }
        .form-section input[type="file"] {
            font-size: 0.875rem;
            color: #4b5563;
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
        }
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .form-section button {
            background-color: #1f2937;
            color: #fff;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .form-section button:hover {
            background-color: #374151;
        }
        .photos-section {
            padding: 1rem;
        }
        .photos-section h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1rem;
        }
        .no-photos {
            color: #4b5563;
        }
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(3, 300px);
            gap: 8px;
            justify-content: center;
        }
        .photo-item {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border: 5px solid #e5e5e5;
        }
        .delete-button {
            position: absolute;
            top: 8px; /* Jarak dari atas gambar */
            right: 8px; /* Jarak dari kanan gambar */
            background-color: #ef4444; /* Background merah */
            color: #fff;
            font-size: 0.65rem; /* Ukuran font kecil */
            padding: 0.2rem 0.5rem; /* Padding kecil biar tombol nggak terlalu besar */
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            opacity: 0.75;
        }
        .delete-button:hover {
            opacity: 1;
        }
    </style>

    <div class="container">
        <!-- Header Profil ala Instagram -->
        <div class="profile-header">
            <!-- Foto Profil -->
            <div class="flex-shrink-0">
                @if ($user->profile_photo)
                    <img src="{{ Storage::url($user->profile_photo) }}" alt="Foto Profil" class="profile-pic">
                @else
                    <div class="profile-placeholder">
                        <span>{{ substr($user->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            <!-- Informasi Profil -->
            <div class="profile-info">
                <!-- Username dan Tombol Edit -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                    <h3>{{ $user->username }}</h3>
                    @if ($isOwnProfile)
                        <a href="{{ route('profile.edit') }}" class="edit-button">Edit Profil</a>
                    @endif
                </div>
                <!-- Statistik -->
                <div class="profile-stats">
                    <div>
                        <span>{{ $photos->count() }}</span> Postingan
                    </div>
                </div>
                <!-- Nama -->
                <div>
                    <p>{{ $user->name }}</p>
                </div>
            </div>
        </div>

        <!-- Form Upload (Hanya untuk Pemilik Profil) -->
        @if ($isOwnProfile)
            <div class="form-section">
                <!-- Update Foto Profil -->
                <div>
                    <h4>Perbarui Foto Profil</h4>
                    @if (session('success'))
                        <p class="success-message">{{ session('success') }}</p>
                    @endif
                    <form method="POST" action="{{ route('photo.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div style="margin-bottom: 0.75rem;">
                            <label for="profile_photo">Pilih Foto</label>
                            <input type="file" name="profile_photo" id="profile_photo">
                            @error('profile_photo')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit">Perbarui Foto</button>
                    </form>
                </div>

                <!-- Upload Foto Baru -->
                <div>
                    <h4>Unggah Foto Baru</h4>
                    <form method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div style="margin-bottom: 0.75rem;">
                            <label for="photo">Pilih Foto</label>
                            <input type="file" name="photo" id="photo">
                            @error('photo')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit">Unggah Foto</button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Grid Foto -->
        <div class="photos-section">
            <h3>Foto</h3>
            @if ($photos->isEmpty())
                <p class="no-photos">Belum ada foto.</p>
            @else
                <div class="photo-grid">
                    @foreach ($photos as $photo)
                        <div class="relative">
                            <img src="{{ Storage::url($photo->url) }}" alt="Foto" class="photo-item">
                            @if ($isOwnProfile)
                                <form action="{{ route('photo.destroy', $photo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Apakah kamu yakin?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>