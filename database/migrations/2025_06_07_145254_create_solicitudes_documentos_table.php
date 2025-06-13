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
        Schema::create('solicitudes_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('tipo_documento');
            $table->date('fecha_solicitud');
            $table->text('comentario')->nullable();
            $table->text('comentario_s')->nullable();
            $table->string('archivo_respuesta')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->string('estado')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->foreignId('revisado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('fecha_revisado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_documentos');
    }
};
