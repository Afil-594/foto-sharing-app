<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserPhotoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('role:admin')->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Route::middleware('auth', 'role:non-admin')->group(function () {
//     Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
//     Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
//     Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
// });

Route::get('/profile/{username}', [UserPhotoController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Fitur baru: Update foto profil, upload, dan hapus foto
    Route::post('/photo/update', [UserPhotoController::class, 'updatePhoto'])->name('photo.update')->middleware('role:non-admin');
    Route::post('/photo/store', [UserPhotoController::class, 'store'])->name('photo.store')->middleware('role:non-admin');
    Route::delete('/photo/{photo}', [UserPhotoController::class, 'destroy'])->name('photo.destroy')->middleware('role:non-admin');
    
    // Dashboard jadi feed
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return app()->make(\App\Http\Controllers\AdminController::class)->dashboard();
        }
        return app()->make(\App\Http\Controllers\UserPhotoController::class)->explore();
    })->name('dashboard');
});

require __DIR__.'/auth.php';
