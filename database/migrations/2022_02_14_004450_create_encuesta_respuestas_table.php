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
        Schema::create('encuesta_respuestas', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('respuesta');

            $table->foreignId('pregunta_id')->constrained('encuesta_preguntas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('encuestado_id')->constrained('encuestados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('encuesta_id')->constrained('encuesta_links')
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
        Schema::dropIfExists('encuesta_respuestas');
    }
};
