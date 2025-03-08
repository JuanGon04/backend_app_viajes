<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';

    protected $fillable = [
        'temperatura',
        'condicion_meteorologica',
        'temperatura_minima',
        'temperatura_maxima',
        'sensacion_termica',
        'ciudad_id',
        'presupuesto_moneda_extranjera',
        'presupuesto_moneda_local',
        'tasa_cambio',
        'simbolo_moneda',
        'tipo_clima'
    ];

    public function Ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'ciudad_id');
    }
}
