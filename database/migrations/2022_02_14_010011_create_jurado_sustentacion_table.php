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
        Schema::create('jurado_sustentacion', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('nota_jurado')->nullable();

            $table->foreignId('jurado_id')->constrained('jurados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('sustentacion_id')->constrained('sustentaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('cargo_jurado_id')->constrained('cargo_jurado')
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
        Schema::dropIfExists('jurado_sustentacion');
    }
};
