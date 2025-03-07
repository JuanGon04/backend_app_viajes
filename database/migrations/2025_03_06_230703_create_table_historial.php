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
        Schema::create('historial', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->decimal('temperatura', 10, 2);
            $table->string('condicion_meteorologica');
            $table->decimal('temperatura_minima', 10, 2);
            $table->decimal('temperatura_maxima', 10, 2);
            $table->decimal('sensacion_termica', 10, 2);
            $table->decimal('presupuesto_moneda_extrangera', 20, 3);
            $table->decimal('presupuesto_moneda_local', 20, 3);
            $table->decimal('tasa_cambio', 20, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
