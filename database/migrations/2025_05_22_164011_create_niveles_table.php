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
        Schema::create('niveles', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('nombre');
            $table->boolean('completado')->default(false);
            $table->date('fecha_completado')->nullable();
            $table->timestamps();
        });

        // Indice de los niveles, que se insertara a la bd, (cada seccion tiene 4actividades), se le asignara un id especifico
        DB::table('niveles')->insert([
            ['id' => 'ABC1', 'nombre' => 'Abecedario - Adivina', 'completado' => false],
            ['id' => 'ABC2', 'nombre' => 'Abecedario - Deletrea', 'completado' => false],
            ['id' => 'ABC3', 'nombre' => 'Abecedario - Conecta', 'completado' => false],
            ['id' => 'ABC4', 'nombre' => 'Abecedario - Extra', 'completado' => false],
            ['id' => 'NUM1', 'nombre' => 'Números - Adivina', 'completado' => false],
            ['id' => 'NUM2', 'nombre' => 'Números - Memorama', 'completado' => false],
            ['id' => 'NUM3', 'nombre' => 'Números - Conecta', 'completado' => false],
            ['id' => 'NUM4', 'nombre' => 'Números - Extra', 'completado' => false],
            ['id' => 'SL1', 'nombre' => 'Saludos - Adivina', 'completado' => false],
            ['id' => 'SL2', 'nombre' => 'Saludos - Memorama', 'completado' => false],
            ['id' => 'SL3', 'nombre' => 'Saludos - Conecta', 'completado' => false],
            ['id' => 'SL4', 'nombre' => 'Saludos - Extra', 'completado' => false],
            ['id' => 'SALUD1', 'nombre' => 'Salud - Adivina', 'completado' => false],
            ['id' => 'SALUD2', 'nombre' => 'Salud - Memorama', 'completado' => false],
            ['id' => 'SALUD3', 'nombre' => 'Salud - Conecta', 'completado' => false],
            ['id' => 'SALUD4', 'nombre' => 'Salud - Extra', 'completado' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveles');
    }
};
