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
        Schema::create('analisis_indicador', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_medicion_inicio')->nullable();
            $table->date('fecha_medicion_fin')->nullable();
            $table->decimal('minimo', 4, 1);
            $table->decimal('satisfactorio', 4, 1);
            $table->decimal('sobresaliente', 4, 1);
            $table->smallInteger('interes')->nullable();
            $table->smallInteger('total')->nullable();
            $table->smallInteger('resultado');
            $table->text('interpretacion')->nullable();
            $table->text('observacion')->nullable();
            $table->string('elaborado_por')->nullable();
            $table->string('revisado_por')->nullable();
            $table->string('aprobado_por')->nullable();

            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('indicadorable_id')->constrained('indicadorables')
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
        Schema::dropIfExists('analisis_indicador');
    }
};
