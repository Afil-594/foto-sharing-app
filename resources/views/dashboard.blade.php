<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="bg-light py-5">
        <div class="container">
            @forelse ($users as $user)
                <div class="card mb-4 shadow-sm">
                    <!-- Header -->
                    <div class="card-body d-flex align-items-center">
                        @if ($user->profile_photo)
                            <img src="{{ Storage::url($user->profile_photo) }}"
                                 class="rounded-circle me-3 border"
                                 width="45" height="45" alt="Profile">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3"
                                 style="width: 45px; height: 45px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h6 class="mb-0">{{ $user->name }}</h6>
                            <small class="text-muted">{{ '@' . $user->username }}</small>
                        </div>
                    </div>

                    <!-- Foto Utama -->
                    @if ($user->photos->isNotEmpty())
                        @php $firstPhoto = $user->photos->first(); @endphp
                        <img src="{{ Storage::url($firstPhoto->url) }}" class="img-fluid" alt="Photo">
                        @if ($user->photos->count() > 1)
                            <div class="card-footer text-muted small">
                                +{{ $user->photos->count() - 1 }} foto lainnya
                            </div>
                        @endif
                    @else
                        <div class="card-footer text-muted small">
                            Belum ada foto.
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-center text-muted">Tidak ada pengguna yang ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>