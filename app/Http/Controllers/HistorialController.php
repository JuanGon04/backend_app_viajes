<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::table('historial_currency_exchange')
    ->join('ciudades', 'historial_currency_exchange.ciudad_id', '=', 'ciudades.id')
    ->join(DB::raw('(SELECT * FROM historialweather WHERE created_at = (SELECT MAX(created_at) FROM historialweather AS hw WHERE hw.ciudad_id = historialweather.ciudad_id)) as historialweather'),
        'historialweather.ciudad_id', '=', 'ciudades.id')
    ->select(
        'historial_currency_exchange.presupuesto_moneda_extranjera',
        'historial_currency_exchange.presupuesto_moneda_local',
        'historial_currency_exchange.tasa_cambio',
        'ciudades.ciudad',
        'ciudades.codigo_divisa',
        'historialweather.temperatura',
        'historialweather.condicion_meteorologica',
        'historialweather.temperatura_minima',
        'historialweather.temperatura_maxima',
        'historialweather.sensacion_termica'
    )
    ->get();


        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
