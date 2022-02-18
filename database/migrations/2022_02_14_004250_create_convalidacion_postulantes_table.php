<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convalidacion_postulantes', function (Blueprint $table) {
            $table->id();
            $table->boolean('es_estudiante_interno');
            $table->string('codigo_estudiante', 15)->unique()->nullable();//<=>OGE

            $table->foreignId('convalidacion_id')->constrained('convalidaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('estudiante_externo_id')->nullable()->constrained('estudiante_externo')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('estado_id')->constrained('estados')
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
        Schema::dropIfExists('convalidacion_postulantes');
    }
};
