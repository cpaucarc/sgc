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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',40);
            $table->string('dni_estudiante', 8);//<=>OGE
            $table->foreignId('escuela_id')->constrained('escuelas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('tipo_solicitud_id')->constrained('tipo_solicitud')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('estado_id')->constrained('estados')
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
        Schema::dropIfExists('solicitudes');
    }
};
