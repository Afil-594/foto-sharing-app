<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

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
        $photos = Photo::where('user_id', $user->id)->get();
        $isOwnProfile = Auth::check() && Auth::user()->username === $username;
        return view('profile.show', compact('user', 'photos', 'isOwnProfile'));
    }

    public function explore()
    {
        $users = User::where('role', '!=', 'admin')->with('photos')->get();
        return view('explore', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('photos', $imageName, 'public');

        $img = Image::make(Storage::disk('public')->path($imagePath));
        $img->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save();

        Photo::create([
            'user_id' => Auth::id(),
            'url' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Photo uploaded successfully');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        Storage::disk('public')->delete($photo->url);
        $photo->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully');
    }
    
}
