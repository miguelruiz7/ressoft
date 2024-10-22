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
        Schema::create('rol_msts', function (Blueprint $table) {
            $table->uuid('rol_uuid')->primary()->comment('Identificador unico del rol');
            $table->string('rol_nom') -> comment('Nombre del rol');
            $table->string('rol_desc') -> comment('Descripción del rol');
            $table->integer('rol_vis') -> comment('Visibilidad del rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_msts');
    }
};
