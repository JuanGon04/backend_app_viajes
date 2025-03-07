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
        Schema::table('historial_currency_exchange', function (Blueprint $table) {
            $table->decimal('tasa_cambio', 20, 6)->after('presupuesto_moneda_local')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_currency_exchange', function (Blueprint $table) {
            $table->dropColumn('tasa_cambio');
            $table->decimal('tasa_cambio', 20, 3);
        });
    }
};
