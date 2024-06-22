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
            $table->id();
            $table->foreignId('personals_id');
            $table->foreignId('ubicacions_id');
            $table->foreignId('comercios_id');
            $table->string('contrato',125);
            $table->string('medidor',125);
            $table->integer('lectura');
            $table->json('anomalia');
            $table->string('imposibilidad');
            $table->text('observaciones')->nullable();
            $table->text('comentarios')->nullable();
            $table->boolean('revisado')->default('0');
            $table->json('imagenes')->nullable();
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
