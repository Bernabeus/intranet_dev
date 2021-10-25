<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class ControllerCategoria extends Controller
{
    public function create(Request $request)
    {

        return  Categoria::create([
            'CODCATEGORIA' => $request->CODCATEGORIA,
            'NOMBRE' => $request->NOMBRE,
            'PORCDEPRECIACION' => $request->PORCDEPRECIACION,
            'CODCONTABLE' => $request->PORCDEPRECIACION,
            'CODPRESENTACION' => $request->PORCDEPRECIACION,
            'CATSUPERIOR' => $request->CATSUPERIOR,
        ]);
    }
    public function index()
    {
        return Categoria::all();
    }

    public function show($CODCATEGORIA)
    {
        return Categoria::find($CODCATEGORIA);
    }

    public function update(Request $request, Categoria $id)
    {
        $id->update($request->all());
    }
}
