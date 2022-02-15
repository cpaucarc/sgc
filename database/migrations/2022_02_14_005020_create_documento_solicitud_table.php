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
        Schema::create('documento_solicitud', function (Blueprint $table) {
            $table->id();
            $table->string('feedback')->nullable();

            $table->foreignId('requisito_id')->constrained('requisitos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('documento_id')->constrained('documentos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('solicitud_id')->constrained('solicitudes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('estado_id')->constrained('estados')
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
        Schema::dropIfExists('documento_solicitud');
    }
};
