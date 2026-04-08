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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('slug')->unique();
            $table->string('dominio')->nullable()->unique();
            $table->string('tema')->default('modern-blue');
            $table->string('logo')->nullable();
            $table->string('imagen_principal')->nullable();
            $table->string('telefono', 40);
            $table->string('email', 120)->nullable();
            $table->string('direccion')->nullable();
            $table->string('slogan')->nullable();
            $table->string('titulo_hero');
            $table->text('texto_hero');
            $table->text('quienes_somos');
            $table->json('caracteristicas')->nullable();
            $table->json('servicios')->nullable();
            $table->json('textos_ui')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
