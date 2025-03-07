<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class ApiWeather
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_API_KEY');
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    }

    public function getWeather($lat, $lon)
    {
        try {
            $response = Http::get($this->baseUrl, [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric',
                'lang' => 'es'
            ]);


            return $response->json();
        } catch (\Exception $e) {
            return ['error' => 'No se pudo obtener el clima: ' . $e->getMessage()];
        }
    }
}






