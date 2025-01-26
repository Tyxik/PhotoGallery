<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function welcome()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('photos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Ulož soubor
        $filePath = $request->file('photo')->store('photos', 'public');
    
        // Vytvoř nový záznam v databázi
        Photo::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
        ]);
    
        return redirect()->route('welcome')->with('success', 'Photo uploaded successfully!');
    }
    
    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }
}
