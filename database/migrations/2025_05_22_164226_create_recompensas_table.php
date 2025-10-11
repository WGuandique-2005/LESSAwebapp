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
        Schema::create('recompensas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('puntos_req');
            // Ruta de la imagen de la recompensa, scr=''
            $table->string('url_imagen')->nullable();
            $table->timestamps();
        });

        // Insertar recompensas iniciales
        DB::table('recompensas')->insert([
            [
                'nombre' => 'Primeros Pasos',
                'descripcion' => 'Has completado tu primer conjunto de ejercicios, continua así!, felicitaciones!',
                'puntos_req' => 2,
                'url_imagen' => 'img/recompensas/primeros_pasos.png'
            ],
            [
                'nombre' => 'Maestria en Letras',
                'descripcion' => 'Has completado con paso perfecto todos los ejercicios de la sección de Abecedario.',
                'puntos_req' => 40,
                'url_imagen' => 'img/recompensas/ABC.png'
            ],
            [
                'nombre' => 'Experto en Números',
                'descripcion' => 'Has completado con paso perfecto todos los ejercicios de la sección de Números.',
                'puntos_req' => 40,
                'url_imagen' => 'img/recompensas/123.png'
            ],
            [
                'nombre' => 'Elocuencia en Saludos',
                'descripcion' => 'Has completado con paso perfecto todos los ejercicios de la sección de Saludos.',
                'puntos_req' => 40,
                'url_imagen' => 'img/recompensas/saludo.png'
            ],
            [
                'nombre' => 'Genio de la Salud',
                'descripcion' => 'Has completado con paso perfecto todos los ejercicios de la sección de Salud.',
                'puntos_req' => 40,
                'url_imagen' => 'img/recompensas/salud.png'
            ],
            [
                'nombre' => 'Maestria Total',
                'descripcion' => 'Has completado con paso perfecto todos los ejercicios de todas las secciones, felicitaciones!',
                'puntos_req' => 160,
                'url_imagen' => 'img/recompensas/maestria_total.png'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recompensas');
    }
};
