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
        Schema::create('historialweather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->decimal('temperatura', 10, 2);
            $table->string('condicion_meteorologica');
            $table->decimal('temperatura_minima', 10, 2);
            $table->decimal('temperatura_maxima', 10, 2);
            $table->decimal('sensacion_termica', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_historial_weather');
    }
};
