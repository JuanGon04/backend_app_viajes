<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use App\Models\HistorialCurrency;
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

        // Guardar en historial con validación
        try {
            $historial = new HistorialCurrency();
            $historial->ciudad_id = $id;
            $historial->presupuesto_moneda_extranjera = $currency['result'] ?? null;
            $historial->presupuesto_moneda_local = $currency['query']['amount'] ?? null;
            $historial->tasa_cambio = $currency['info']['rate'] ?? null;
            $historial->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar en historial', 'detalle' => $e->getMessage()], 500);
        }

        return response()->json(array_merge($currency, ['simbolo_moneda' => $ciudad->simbolo_moneda]));
    }

}


