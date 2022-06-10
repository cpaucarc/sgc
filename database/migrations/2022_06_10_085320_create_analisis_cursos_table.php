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
        Schema::create('analisis_cursos', function (Blueprint $table) {
            $table->id();
            $table->integer('analisis_indicador_id');
            $table->integer('curso_id');
            $table->foreignId('analisis_indicador_id')->constrained('analisis_indicador')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('curso_id')->constrained('cursos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analisis_cursos');
    }
};
