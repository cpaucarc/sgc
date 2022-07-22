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
        Schema::create('analisis_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analisis_indicador_id')->constrained('analisis_indicador')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')
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
        Schema::dropIfExists('analisis_servicios');
    }
};
