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
        Schema::create('indicadorables', function (Blueprint $table) {
            $table->id();
            $table->string('cod_ind_final', 15);
            $table->decimal('minimo', 4, 1);
            $table->decimal('sobresaliente', 4, 1);
            $table->unsignedBigInteger('indicadorable_id');
            $table->string('indicadorable_type');
            $table->foreignId('indicador_id')->constrained('indicadores')
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
        Schema::dropIfExists('indicadorables');
    }
};
