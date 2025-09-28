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
            $table->foreignId('leccion_id');
            $table->string('titulo');
            $table->timestamps();

        });

        // Ingresar las lecciones
        DB::table('lecciones')->insert([
            ['leccion_id' => 1, 'titulo' => 'Abecedario'],
            ['leccion_id' => 2, 'titulo' => 'Números'],
            ['leccion_id' => 3, 'titulo' => 'Saludos'],
            ['leccion_id' => 4, 'titulo' => 'Salud'],
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
