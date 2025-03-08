<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use App\Services\ApiCurrencyExchange;

class CurrencyExchangeController extends Controller
{
    protected $currencyService;

    public function __construct(ApiCurrencyExchange $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function findCity($id){
        $ciudad = Ciudades::select('codigo_divisa', 'simbolo_moneda')->where('id', $id)->first();

        if (!$ciudad) {
            return response()->json(['mensaje' => 'Ciudad no encontrada'], 404);
        }

        return $ciudad;
    }

    public function consultarApiCurrency(Request $request){
    
        $id = $request->query('id');
        $amount = $request->query('amount');

        if (!$id||!$amount) {
            return response()->json(['mensaje' => 'El id y la total de la modena local son obligatorios'], 402);
        }

        $ciudad = $this->findCity($id);

        $currency = $this->currencyService->getCurrency($ciudad->codigo_divisa, $amount);

        return response()->json(array_merge($currency, ['simbolo_moneda' => $ciudad->simbolo_moneda]));
    }

}


