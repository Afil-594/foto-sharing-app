<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserPhotoController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        $user->update([
            'profile_photo' => $path,
        ]);

        return redirect()->back()->with('success', 'Profile photo updated successfully');
    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $photos = \App\Models\Photo::where('user_id', $user->id)->get();
        $isOwnProfile = Auth::check() && Auth::user()->username === $username;
        return view('profile.show', compact('user', 'photos', 'isOwnProfile'));
    }

    public function explore()
    {
        $users = User::where('role', '!=', 'admin')->with('photos')->get();
        return view('explore', compact('users'));
    }
}
