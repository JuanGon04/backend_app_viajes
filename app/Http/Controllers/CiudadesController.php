<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciudades;

class CiudadesController extends Controller
{
    public function index()
    {
        $ciudades = Ciudades::select('id','ciudad')->get();
    
        return response()->json($ciudades);
    }
}
