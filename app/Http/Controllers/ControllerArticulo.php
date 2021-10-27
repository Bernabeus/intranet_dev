<?php

namespace App\Http\Controllers;


use App\Http\Resources\Articulo as ArticuloResource;
use App\Http\Resources\ArticuloCollection;
use App\Models\Ubicacion;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ControllerArticulo extends Controller
{
    public function create(Request $request)
    {
        return  Articulo::create([
            'CODARTICULO' => $request->CODARTICULO,
            'CODUBICACION' => $request->CODUBICACION,
            'CODDETASIG' => $request->CODDETASIG,
            'CODDETBAJA' => $request->CODDETBAJA,
            'CODCATEGORIA' => $request->CODCATEGORIA,
            'CODIGOPRESENTACION' => $request->CODIGOPRESENTACION,
            'CODIGOCONTABLE' => $request->CODIGOCONTABLE,
            'NOMBRE' => $request->NOMBRE,
            'PRECIO' => $request->PRECIO,
            'DESCRIPCION' => $request->DESCRIPCION,
            'FECHAOBTENCION' => $request->FECHAOBTENCION,
            'NSERIE' => $request->NSERIE,
            'ESTADO' => 1,
        ]);
    }
    public function index()
    {
        return new ArticuloCollection(Articulo::all());

    }

    public function show($CODARTICULO)
    {
        return Articulo::find($CODARTICULO);
    }

    public function update(Request $request, Articulo $id)
    {
        $id->update($request->all());
    }
}
