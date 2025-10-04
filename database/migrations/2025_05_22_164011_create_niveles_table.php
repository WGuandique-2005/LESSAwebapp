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
            $table->timestamps();
        });

        // Indice de los niveles, que se insertara a la bd, (cada seccion tiene 4actividades), se le asignara un id especifico
        DB::table('niveles')->insert([
            ['id' => 'ABC1', 'nombre' => 'Abecedario - Adivina'],
            ['id' => 'ABC2', 'nombre' => 'Abecedario - Deletrea'],
            ['id' => 'ABC3', 'nombre' => 'Abecedario - Conecta'],
            ['id' => 'ABC4', 'nombre' => 'Abecedario - Extra'],
            ['id' => 'NUM1', 'nombre' => 'Números - Adivina'],
            ['id' => 'NUM2', 'nombre' => 'Números - Memorama'],
            ['id' => 'NUM3', 'nombre' => 'Números - Conecta'],
            ['id' => 'NUM4', 'nombre' => 'Números - Extra'],
            ['id' => 'SL1', 'nombre' => 'Saludos - Adivina'],
            ['id' => 'SL2', 'nombre' => 'Saludos - Memorama'],
            ['id' => 'SL3', 'nombre' => 'Saludos - Conecta'],
            ['id' => 'SL4', 'nombre' => 'Saludos - Extra'],
            ['id' => 'SALUD1', 'nombre' => 'Salud - Adivina'],
            ['id' => 'SALUD2', 'nombre' => 'Salud - Memorama'],
            ['id' => 'SALUD3', 'nombre' => 'Salud - Conecta'],
            ['id' => 'SALUD4', 'nombre' => 'Salud - Extra'],
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
