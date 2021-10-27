<?php

namespace App\Http\Controllers;

use App\Models\CategoriaArticulo;
use Illuminate\Http\Request;

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
        return CategoriaArticulo::find($CODCATEGORIA);
    }

    public function update(Request $request, CategoriaArticulo $id)
    {
        $id->update($request->all());
    }
}
