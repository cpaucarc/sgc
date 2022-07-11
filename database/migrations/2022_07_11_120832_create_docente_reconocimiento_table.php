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
        Schema::create('docente_reconocimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('docentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('reconocido')->default(false);
            $table->foreignId('departamento_id')->constrained('departamentos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')
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
        Schema::dropIfExists('docente_reconocimiento');
    }
};
