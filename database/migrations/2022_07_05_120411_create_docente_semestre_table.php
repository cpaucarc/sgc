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
        Schema::create('docente_semestre', function (Blueprint $table) {
            $table->id();
            $table->boolean('cumple_40h')->default(false);
            $table->boolean('cumplio_40h')->nullable();
            $table->boolean('cumplio_labores')->nullable();
            $table->foreignId('docente_id')->constrained('docentes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docente_semestre');
    }
};
