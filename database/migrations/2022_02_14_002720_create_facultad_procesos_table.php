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
        Schema::create('facultad_procesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facultad_id')->constrained('facultades')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('proceso_id')->constrained('procesos')
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
        Schema::dropIfExists('facultad_procesos');
    }
};
