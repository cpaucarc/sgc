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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('curricula', 2);
            $table->string('codigo', 7);
            $table->string('nombre');
            $table->integer('horas_teoria');
            $table->integer('horas_practica');
            $table->foreignId('escuela_id')->constrained('escuelas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('ciclo_id')->constrained('ciclos')
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
        Schema::dropIfExists('cursos');
    }
};
