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
        Schema::create('encuesta_links', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->date('fecha_expiracion');
            $table->unsignedBigInteger('encuestable_id');
            $table->string('encuestable_type');
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
        Schema::dropIfExists('encuesta_links');
    }
};
