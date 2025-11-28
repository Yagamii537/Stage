<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_evento');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('lugar')->nullable();
            $table->string('cliente')->nullable();
            $table->foreignId('responsable_id')
                ->nullable()
                ->constrained('responsables')
                ->nullOnDelete();
            $table->enum('estado', ['planificado', 'en_curso', 'finalizado', 'cancelado'])
                ->default('planificado');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
