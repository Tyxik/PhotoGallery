<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Spuštění migrace (vytvoření tabulky).
     */
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id(); // Primární klíč
            $table->string('title'); // Název fotografie (např. "Sunset at Beach")
            $table->string('file_path'); // Relativní cesta k souboru (např. "photos/sunset.jpg")
            $table->timestamps(); // Sloupce 'created_at' a 'updated_at'
        });
    }

    /**
     * Reverzní operace (odstranění tabulky při rollbacku).
     */
    public function down(): void
    {
        Schema::dropIfExists('photos'); // Smazání tabulky 'photos'
    }
};
