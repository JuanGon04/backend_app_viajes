<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class ApiCurrencyExchange
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('CURRENCY_API_KEY');
        $this->baseUrl = 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert';
    }

    public function getCurrency($divisa, $amount)
    {
        try {

            $from = 'COP';

            $response = Http::withHeaders([
                'X-RapidAPI-Key' => $this->apiKey,
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ])->get($this->baseUrl, [
                'from' => $from,
                'to' => $divisa,
                'amount' => $amount,
            ]);


            return $response->json();
        } catch (\Exception $e) {
            return ['error' => 'No se pudo obtener el clima: ' . $e->getMessage()];
        }
    }
}






