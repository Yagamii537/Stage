<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipo_evento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->cascadeOnDelete();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
            $table->unsignedInteger('cantidad_salida');
            $table->unsignedInteger('cantidad_retorno')->default(0);
            $table->enum('estado_retorno', ['pendiente', 'ok', 'danado', 'perdido', 'faltante'])
                ->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipo_evento');
    }
};
