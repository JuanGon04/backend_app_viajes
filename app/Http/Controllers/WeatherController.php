<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use App\Services\ApiWeather;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(ApiWeather $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function consultarApiWeather($id)
    {
        $ciudad = Ciudades::select('ciudad', 'latitud', 'longitud')
                  ->where('id', $id)
                  ->first();

        if ($ciudad) {
            $lat = $ciudad->latitud;
            $lon = $ciudad->longitud;
        } else {
            return response()->json(['mensaje' => 'Ciudad no encontrada'], 404);
        }
        
        $weather = $this->weatherService->getWeather($lat, $lon);

        
        return response()->json(array_merge($weather, ['id_ciudad' => $id]));

    }
}

