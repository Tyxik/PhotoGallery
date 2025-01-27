<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Zobrazení hlavní stránky s fotkami
    public function welcome()
    {
        // Načti všechny fotografie z databáze, seřazené podle data vytvoření
        $photos = Photo::orderBy('created_at', 'desc')->get();

        // Předání fotografií do šablony 'welcome.blade.php'
        return view('welcome', compact('photos'));
    }

    // Uložení nové fotografie
    public function store(Request $request)
    {
        // Validace vstupu
        $request->validate([
            'title' => 'required|string|max:255', // Název je povinný
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Fotografie musí být obrázek
        ]);

        // Kontrola složky pro ukládání
        if (!Storage::disk('public')->exists('photos')) {
            Storage::disk('public')->makeDirectory('photos'); // Vytvoří složku, pokud neexistuje
        }

        // Uložení souboru do složky 'photos' v 'storage/app/public'
        $filePath = $request->file('photo')->store('photos', 'public');

        // Uložení informace o fotografii do databáze
        Photo::create([
            'title' => $request->input('title'), // Název z formuláře
            'file_path' => $filePath, // Cesta k souboru
        ]);

        // Přesměrování s úspěšnou zprávou
        return redirect()->route('welcome')->with('success', 'Photo uploaded successfully!');
    }

    // Smazání fotografie
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

    // Metoda pro zobrazení galerie (volitelné)
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();
        return view('photos.index', compact('photos'));
    }
}
