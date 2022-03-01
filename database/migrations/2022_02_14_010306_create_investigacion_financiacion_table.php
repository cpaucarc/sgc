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
        Schema::create('investigacion_financiacion', function (Blueprint $table) {
            $table->id();
            $table->decimal('presupuesto', 10, 2);

            $table->foreignId('investigacion_id')->constrained('investigaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('financiador_id')->constrained('financiadores')
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
        Schema::dropIfExists('investigacion_financiacion');
    }
};
