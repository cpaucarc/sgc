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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->string('objetivo');
            $table->string('titulo_interes')->nullable();
            $table->string('titulo_total')->nullable();
            $table->string('titulo_resultado');
            $table->string('cod_ind_inicial');
            $table->string('formula')->nullable();
            $table->decimal('minimo', 4, 1);
            $table->decimal('satisfactorio', 4, 1);
            $table->decimal('sobresaliente', 4, 1);

            $table->foreignId('unidad_medida_id')->constrained('unidad_medida')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('frecuencia_medicion_id')->constrained('frecuencias')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('frecuencia_reporte_id')->constrained('frecuencias')
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
        Schema::dropIfExists('indicadores');
    }
};
