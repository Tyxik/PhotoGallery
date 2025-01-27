<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id(); // Primární klíč
            $table->string('title'); // Název fotografie
            $table->string('file_path'); // Cesta k souboru
            $table->timestamps(); // Sloupce pro čas vytvoření a aktualizace
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos'); // Odstraní tabulku při rollbacku
    }
};
