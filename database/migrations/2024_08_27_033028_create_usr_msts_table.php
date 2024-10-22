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
        Schema::create('usr_msts', function (Blueprint $table) {
            $table->uuid('usr_uuid')->primary()->comment('Identificador del usuario');
            $table->string('usr_nom', 90)->comment('Nombre del usuario');
            $table->string('usr_cor', 255)->comment('Correo electrónico del usuario');
            $table->string('usr_usu', 90)->comment('Nombre del usuario');
            $table->string('usr_con', 90)->comment('Contraseña del usuario');
            $table->uuid('usr_rol_uuid')->comment('Rol al que pertene el usuario');
            $table->integer('usr_vis')->default(1)->comment('Visibilidad del usuario (1 activo, 0 inactivo)');
            $table->integer('usr_ver')->default(0)->comment('Verificación de usuario por correo electrónico (1 activo, 0 inactivo)');
            $table->integer('usr_ver_cod')->comment('Codigo de verificación del usuario');
            $table->integer('usr_con_res')->default(0)->comment('Solicita restablecimiento de contraseña (0: Ninguna, 1: Activa)');
            $table->foreign('usr_rol_uuid')->references('rol_uuid')->on('rol_msts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usr_msts');
    }
};
