<?php

namespace App\Http\Controllers;

use App\Models\CategoriaArticulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerCategoriaArticulo extends Controller
{
    public function create(Request $request)
    {
        return  CategoriaArticulo::create([
            'CODCATEGORIA' => $request->CODCATEGORIA,
            'NOMBRE' => $request->NOMBRE,
            'PORCENTAJEDEPRECIACION' => $request->PORCENTAJEDEPRECIACION,
            'CODIGOCONTABLE' => $request->CODIGOCONTABLE,
            'CODIGOPRESENTACION' => $request->CODIGOPRESENTACION,
            'CATSUPERIOR' => $request->CATSUPERIOR,
        ]);
    }
    public function index()
    {
        return CategoriaArticulo::all();
    }

    public function show($CODCATEGORIA)
    {
        return DB::table('categoria_art')->where('CODCATEGORIA', $CODCATEGORIA)->get();
    }

    public function update(Request $request, CategoriaArticulo $id)
    {
        $id->update($request->all());
    }
}
