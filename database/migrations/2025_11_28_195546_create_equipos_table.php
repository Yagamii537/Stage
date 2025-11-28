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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo'); // consola, micro, cable, luz, cámara...
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('num_serie')->nullable();
            $table->enum('estado', ['disponible', 'en_evento', 'mantenimiento', 'perdido'])
                ->default('disponible');
            $table->integer('cantidad_total')->default(0);
            $table->integer('cantidad_disponible')->default(0);
            $table->string('foto')->nullable(); // ruta de imagen si quieres
            $table->string('qr_code')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
