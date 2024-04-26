<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('personal_id');
            $table->string('contrato',125);
            $table->string('medidor',125);
            $table->string('medidor_anomalia',125)->nullable();
            $table->integer('lectura');
            $table->string('tipo_comercio');
            $table->string('nuevo_comercio')->nullable();
            $table->string('direccion');
            $table->json('anomalia');
            $table->string('imposibilidad');
            $table->text('observaciones')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('latitud');
            $table->string('longitud');
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->string('foto4')->nullable();
            $table->string('foto5')->nullable();
            $table->string('foto6')->nullable();
            $table->string('video')->nullable();
            $table->string('estado')->default('5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
