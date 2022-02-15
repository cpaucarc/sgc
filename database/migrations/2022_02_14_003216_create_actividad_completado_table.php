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
        Schema::create('actividad_completado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')
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
        Schema::dropIfExists('actividad_completado');
    }
};
