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
        Schema::create('capacitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 40);
            $table->text('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
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
        Schema::dropIfExists('capacitaciones');
    }
};
