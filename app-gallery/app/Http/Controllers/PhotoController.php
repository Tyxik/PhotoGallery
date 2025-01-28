<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Zobrazení hlavní stránky s fotkami
     */
    public function welcome()
    {
        // Načti všechny fotografie z databáze, seřazené podle data vytvoření
        $photos = Photo::orderBy('created_at', 'desc')->get();

        // Předání fotografií do šablony 'welcome.blade.php'
        return view('welcome', compact('photos'));
    }

    /**
     * Uložení nové fotografie
     */
    public function store(Request $request)
{
    // Validace vstupu
    $validated = $request->validate([
        'title' => 'required|string|max:255', // Název je povinný
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Fotografie musí být obrázek
    ]);

    // Získání souboru
    $file = $request->file('photo');

    // Nastavení cesty pro uložení souboru do public/storage
    $filePath = $file->move(public_path('storage/photos'), $file->getClientOriginalName());

    // Uložení informace o fotografii do databáze
    Photo::create([
        'title' => $validated['title'], // Název z formuláře
        'file_path' => 'photos/' . $file->getClientOriginalName(), // Relativní cesta
    ]);

    // Přesměrování s úspěšnou zprávou
    return redirect()->route('welcome')->with('success', 'Photo uploaded successfully!');
}

    /**
     * Smazání fotografie
     */
    public function destroy(Photo $photo)
    {
        // Smazání souboru z úložiště
        if (Storage::disk('public')->exists($photo->file_path)) {
            Storage::disk('public')->delete($photo->file_path);
        }

        // Smazání záznamu z databáze
        $photo->delete();

        // Přesměrování s úspěšnou zprávou
        return redirect()->route('welcome')->with('success', 'Photo deleted successfully.');
    }

    /**
     * Zobrazení galerie
     */
    public function index(Request $request)
    {
        // Filtrování podle vyhledávacího dotazu
        $search = $request->input('search');
        $photos = Photo::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        // Předání fotografií do šablony 'photos.index'
        return view('photos.index', compact('photos', 'search'));
    }

    /**
     * Zobrazení jedné fotografie
     */
    public function show($id)
    {
        // Najdi fotografii podle ID
        $photo = Photo::findOrFail($id);

        // Předání konkrétní fotografie do šablony
        return view('photos.show', compact('photo'));
    }
}
