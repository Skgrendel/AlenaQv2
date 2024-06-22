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
        Schema::create('surtigas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personals_id')->nullable();
            $table->string('contrato');
            $table->string('direccion');
            $table->string('barrio');
            $table->string('medidor');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('ciclo');
            $table->boolean('estado')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surtigas');
    }
};
