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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('oficina_id')->constrained('oficinas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('entrada_id')->constrained('entradas')
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
        Schema::dropIfExists('proveedores');
    }
};
