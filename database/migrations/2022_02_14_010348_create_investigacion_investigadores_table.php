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
        Schema::create('investigacion_investigadores', function (Blueprint $table) {
            $table->id();
            $table->boolean('es_responsable')->default(false);

            $table->foreignId('investigacion_id')->constrained('investigaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('investigador_id')->constrained('investigadores')
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
        Schema::dropIfExists('investigacion_investigadores');
    }
};
