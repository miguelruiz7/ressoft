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
        Schema::create('rol_dets', function (Blueprint $table) {
            $table->uuid('rol_uuid_')->primary()->comment('Identificador unico del rol-permiso');
            $table->uuid('rol_rol_uuid')->comment('Rol');
            $table->uuid('rol_per_uuid')->comment('Permiso al que pertenece rol');

            $table->foreign('rol_rol_uuid')->references('rol_uuid')->on('rol_msts')->onDelete('cascade');
            $table->foreign('rol_per_uuid')->references('per_uuid')->on('per_msts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_dets');
    }
};
