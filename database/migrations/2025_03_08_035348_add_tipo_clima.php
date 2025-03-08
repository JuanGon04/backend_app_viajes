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
        Schema::table('historial', function (Blueprint $table) {
            $table->string('tipo_clima')->nullable();
            $table->decimal('presupuesto_moneda_extranjera', 20, 2)->after('presupuesto_moneda_local')->change();
            $table->decimal('presupuesto_moneda_local', 20, 2)->after('sensacion_termica')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            $table->dropColumn('tipo_clima');
            $table->dropColumn('presupuesto_moneda_local');
            $table->dropColumn('presupuesto_moneda_extranjera');
            $table->decimal('presupuesto_moneda_extranjera', 20, 3);
            $table->decimal('presupuesto_moneda_local', 20, 3);
        });
    }
};
