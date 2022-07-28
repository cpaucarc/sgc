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
        Schema::create('responsables_salidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responsable_id')->constrained('responsables')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('salida_id')->constrained('salidas')
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
        Schema::dropIfExists('responsables_salidas');
    }
};
