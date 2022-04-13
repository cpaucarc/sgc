<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesis', function (Blueprint $table) {
            $table->id();
            $table->string('numero_registro', 10)->unique();
            $table->text('titulo');
            $table->year('anio');
            $table->string('dni_estudiante', 8);//<=>OGE

            $table->foreignId('escuela_id')->constrained('escuelas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('asesor_id')->constrained('jurados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('tipo_tesis_id')->constrained('tipo_tesis')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesis');
    }
};
