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
        Schema::create('formato_requisito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisito_id')->constrained('requisitos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('documento_id')->constrained('documentos')
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
        Schema::dropIfExists('formato_requisito');
    }
};
