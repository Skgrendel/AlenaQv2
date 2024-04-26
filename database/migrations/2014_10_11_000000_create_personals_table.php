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
        Schema::create('personals', function (Blueprint $table) {
            $table->smallIncrements('id')->unsigned();
            $table->string('tipo_documento');
            $table->string('numero_documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->string('correo');
            $table->string('estado',9)->default('3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
