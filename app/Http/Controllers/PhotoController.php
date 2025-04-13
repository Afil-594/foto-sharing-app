<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::where('user_id', Auth::id())->get();
        return view('photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = Image::make($request->file('photo'));
        $image->resize(1080, 1080, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $path = 'photos/' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
        Storage::disk('public')->put($path, $image->encode());

        Photo::create([
            'user_id' => Auth::id(),
            'url' => $path,
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo uploaded successfully');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        Storage::disk('public')->delete($photo->url);
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully');
    }
}