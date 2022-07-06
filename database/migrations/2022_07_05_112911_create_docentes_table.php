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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('grado', 1);
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('categoria_id')->constrained('docente_categorias')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('condicion_id')->constrained('docente_condicion')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dedicacion_id')->constrained('docente_dedicacion')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
};
