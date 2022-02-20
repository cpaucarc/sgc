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
        Schema::create('responsabilidad_social', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('uuid', 40);
            $table->text('descripcion')->nullable();
            $table->string('lugar');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();

            $table->foreignId('semestre_id')->constrained('semestres')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('escuela_id')->constrained('escuelas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')
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
        Schema::dropIfExists('responsabilidad_social');
    }
};
