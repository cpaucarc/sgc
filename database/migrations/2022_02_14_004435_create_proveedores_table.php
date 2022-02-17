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
            $table->foreignId('responsable_id')->constrained('responsables')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('entidad_id')->constrained('entidades')
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
