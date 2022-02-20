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
        Schema::create('entidadables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entidadable_id')->nullable();
            $table->string('entidadable_type')->nullable();
            $table->foreignId('entidad_id')->constrained('entidades')
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
        Schema::dropIfExists('entidadables');
    }
};
