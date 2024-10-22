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
        Schema::create('per_msts', function (Blueprint $table) {
            $table->uuid('per_uuid')->primary()->comment('Identificador unico del permiso');
            $table->string('per_desc') -> comment('Descripción del permiso');
            $table->string('per_sgl') -> comment('Siglas del permiso, per_"modulo"_"lec/esc" cuando se agregue un nuevo modulo agregarlo en el seeder correspondiente');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('per_msts');
    }
};
