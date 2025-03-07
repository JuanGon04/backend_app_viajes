<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialWeather extends Model
{

    protected $table = 'historialweather';
    protected $primaryKey = 'id'; // Utiliza la columna 'id' como clave primaria
    public $incrementing = true; // La columna 'id' es incrementada automáticamente
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = [
        'temperatura',
        'condicion_meteorologica',
        'temperatura_minima',
        'temperatura_maxima',
        'sensacion_termica',
        'ciudad_id'
    ];

    public function Ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'ciudad_id');
    }
}
