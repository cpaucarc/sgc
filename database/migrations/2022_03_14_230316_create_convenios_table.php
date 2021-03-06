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
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('realizados');
            $table->smallInteger('vigentes');
            $table->smallInteger('culminados');
            $table->foreignId('semestre_id')->constrained('semestres')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('facultad_id')->constrained('facultades')
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
        Schema::dropIfExists('convenios');
    }
};
