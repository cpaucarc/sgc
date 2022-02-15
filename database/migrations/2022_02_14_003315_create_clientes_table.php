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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('salida_id')->constrained('salidas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('oficina_id')->constrained('oficinas')
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
        Schema::dropIfExists('clientes');
    }
};
