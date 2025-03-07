<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialCurrency extends Model
{
    protected $table = 'historial_currency_exchange';
    protected $primaryKey = 'id'; // Utiliza la columna 'id' como clave primaria
    public $incrementing = true; // La columna 'id' es incrementada automáticamente
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = [
        'presupuesto_moneda_extranjera',
        'presupuesto_moneda_local',
        'tasa_cambio',
        'ciudad_id'
    ];

    public function Ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'ciudad_id');
    }
}
