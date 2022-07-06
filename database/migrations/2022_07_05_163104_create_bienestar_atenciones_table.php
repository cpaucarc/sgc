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
        Schema::create('bienestar_atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('servicios')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('mes');
            $table->integer('anio');
            $table->integer('atenciones');
            $table->integer('total')->nullable();
            $table->foreignId('escuela_id')->constrained('escuelas')
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
        Schema::dropIfExists('bienestar_atenciones');
    }
};
