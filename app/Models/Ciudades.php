<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    protected $fillable = ['ciudad','codigo_divisa','latitud','longitud', 'pais', 'simbolo_moneda'];

    public function historiales()
    {
        return $this->hasMany(HistorialCurrency::class, 'ciudad_id');
    }

}
