<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use App\Models\HistorialWeather;
use Illuminate\Http\Request;
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

        if($weather){
            $historial = new HistorialWeather();
            $historial->ciudad_id = $id;
            $historial->temperatura = $weather['main']['temp'];
            $historial->condicion_meteorologica = $weather['weather'][0]['description'];
            $historial->temperatura_minima = $weather['main']['temp_min'];
            $historial->temperatura_maxima = $weather['main']['temp_max'];
            $historial->sensacion_termica = $weather['main']['feels_like'];
            $historial->save();
    
            return response()->json($weather);
        }else{
            return response()->json(['mensaje' => 'No se obtuvo respuesta de la API del clima'], 502);
        }

        

    }
}

