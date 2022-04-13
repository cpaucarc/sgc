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
        Schema::create('rsu_participantes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_incorporacion');
            $table->boolean('es_responsable')->default(false);
            $table->boolean('es_estudiante');
            $table->string('dni_participante', 8);//<=>OGE
            $table->foreignId('responsabilidad_social_id')->constrained('responsabilidad_social')
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
        Schema::dropIfExists('rsu_participantes');
    }
};
