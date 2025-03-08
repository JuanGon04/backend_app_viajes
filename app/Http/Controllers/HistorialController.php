<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $historial = Historial::join('ciudades', 'historial.ciudad_id', '=', 'ciudades.id')
            ->select('historial.*', 'ciudades.ciudad as ciudad', 'ciudades.pais as pais')
            ->orderBy('historial.id', 'desc') // Ordenar por ID en orden descendente
            ->limit(4) // Obtener solo los últimos 5
            ->get();

    
            if ($historial->isEmpty()) {
                return response()->json(['message' => 'No hay registros en el historial'], 200);
            }
    
            return response()->json($historial);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el historial', 'detalle' => $e->getMessage()], 500);
        }
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar datos
            $datos = $request->validate([
                'temperatura' => 'required',
                'condicion_meteorologica'=> 'required',
                'temperatura_minima' => 'required',
                'temperatura_maxima'=> 'required',
                'sensacion_termica'=> 'required',
                'ciudad_id'=> 'required',
                'presupuesto_moneda_extranjera' => 'required',
                'presupuesto_moneda_local'=>'required',
                'tasa_cambio'=>'required',
                'simbolo_moneda'=>'required',
                'tipo_clima'=>'required',
            ]);

            // Guardar en la base de datos con asignación masiva
            $historial = Historial::create($datos);

            return response()->json(['message' => 'Historial guardado correctamente', 'data' => $historial], 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación', 'detalle' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar en historial', 'detalle' => $e->getMessage()], 500);
        }
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
