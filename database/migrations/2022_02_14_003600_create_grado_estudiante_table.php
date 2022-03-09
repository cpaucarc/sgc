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
        Schema::create('grado_estudiante', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_estudiante', 15)->unique(); // OGE
            $table->foreignId('grado_academico_id')->constrained('grado_academico')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('escuela_id')->default(1)->constrained('escuelas') //FIXME Quitar default 1
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_estudiante');
    }
};
