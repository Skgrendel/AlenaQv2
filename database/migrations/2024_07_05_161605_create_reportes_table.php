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
            $table->foreignId('ubicacions_id')
                ->constrained('ubicacions')
                ->onDelete('cascade');
            $table->foreignId('comercios_id')
                ->constrained('comercios')
                ->onDelete('cascade');
            $table->foreignId('surtigas_id')
                ->constrained('surtigas')
                ->onDelete('cascade');
            $table->string('lectura');
            $table->json('anomalia');
            $table->string('imposibilidad');
            $table->json('imagenes')->nullable();
            $table->string('video')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('comentarios')->nullable();
            $table->boolean('revisado')->default('0');
            $table->boolean('confirmado')->default('0');
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
