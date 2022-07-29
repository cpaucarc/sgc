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
        Schema::create('auditoria_interna_detalle', function (Blueprint $table) {
            $table->id();
            $table->text('observacion')->nullable();
            $table->foreignId('auditoria_interna_id')->constrained('auditorias_internas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('responsable_salida_id')->constrained('responsables_salidas')
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
        Schema::dropIfExists('auditoria_interna_detalle');
    }
};
