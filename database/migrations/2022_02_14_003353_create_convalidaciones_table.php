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
        Schema::create('convalidaciones', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('vacantes');
            $table->foreignId('escuela_id')->constrained('escuelas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')
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
        Schema::dropIfExists('convalidaciones');
    }
};
