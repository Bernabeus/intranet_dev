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
            'PORC_DEPRECIACION' => $request->PORC_DEPRECIACION,
            'DESCRIPCION' => $request->DESCRIPCION,
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
