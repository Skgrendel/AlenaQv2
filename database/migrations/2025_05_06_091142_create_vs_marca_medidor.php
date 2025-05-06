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
        DB::statement('DROP VIEW IF EXISTS vs_marca_medidor');
        DB::statement('CREATE VIEW vs_marca_medidor AS SELECT id, nombre,nomenclatura FROM encabezados_dets WHERE encabezados_id = 7');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
