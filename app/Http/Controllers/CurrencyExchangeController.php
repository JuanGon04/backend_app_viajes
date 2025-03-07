<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiCurrencyExchange;

class CurrencyExchangeController extends Controller
{
    protected $currencyService;

    public function __construct(ApiCurrencyExchange $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function consultarApiCurrency(Request $request)
    {
        $to = $request->query('to');
        $amout = $request->query('amout');

        // Validar que los parámetros existen
        if (!$to || !$amout) {
            return response()->json(['error' => ' y longitud son requeridos'], 400);
        }
        
        $currency = $this->currencyService->getCurrency($to, $amout);

        

        return response()->json($currency);
    }
}
