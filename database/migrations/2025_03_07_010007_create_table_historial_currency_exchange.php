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
        Schema::create('historial_currency_exchange', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
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
        Schema::dropIfExists('table_historial_currency_exchange');
    }
};
