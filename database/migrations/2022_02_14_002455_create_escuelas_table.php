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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('uuid', 40);
            $table->string('abrev', 10)->nullable();
            $table->integer('depto_id')->nullable(); // correspondencia entre escuela_id y depto_id, cuando comparten el mismo nombre la escuela y el depto academico
            $table->foreignId('facultad_id')->constrained('facultades')
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
        Schema::dropIfExists('escuelas');
    }
};
