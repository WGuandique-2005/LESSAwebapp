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
        Schema::create('lecciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id');
            $table->string('titulo');
            $table->timestamps();

        });

        // Ingresar las lecciones
        DB::table('lecciones')->insert([
            ['nivel_id' => 1, 'titulo' => 'Abecedario'],
            ['nivel_id' => 2, 'titulo' => 'Números'],
            ['nivel_id' => 3, 'titulo' => 'Saludos'],
            ['nivel_id' => 4, 'titulo' => 'Salud'],
            ['nivel_id' => 5, 'titulo' => 'Emociones'],
            ['nivel_id' => 6, 'titulo' => 'Comida'],
            ['nivel_id' => 7, 'titulo' => 'Animales'],
            ['nivel_id' => 8, 'titulo' => 'Extra'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecciones');
    }
};
