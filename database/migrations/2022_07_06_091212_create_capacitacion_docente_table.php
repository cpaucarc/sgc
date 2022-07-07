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
        Schema::create('capacitacion_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capacitacion_id')->constrained('capacitaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('docentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('participa')->default(false);
            $table->foreignId('departamento_id')->constrained('departamentos')
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
        Schema::dropIfExists('capacitacion_docente');
    }
};
