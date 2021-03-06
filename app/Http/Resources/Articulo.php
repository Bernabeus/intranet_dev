<?php

namespace App\Http\Resources;

use App\Models\DetalleAsignacion;
use App\Models\Empleado;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ubicacion;
use App\Models\CategoriaArticulo;

class Articulo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        if ($this->CODDETASIG !== null) {
            $data = DetalleAsignacion::query()->where('CODDETASIG', $this->CODDETASIG)->select(['CODEMPLEADO'])->get();
            $custodio['NOMBRE'] = Empleado::find($data[0]['CODEMPLEADO'])->NOMBRE . ' ' . Empleado::find($data[0]['CODEMPLEADO'])->APELLIDO;
            $custodio['CODEMPLEADO'] = $data[0]['CODEMPLEADO'];
        } else {
            $custodio = '';
        };


        return [
            'CODARTICULO' => $this->CODARTICULO,
            'CODUBICACION' => Ubicacion::find($this->CODUBICACION),
            'CODDETASIG' => $this->CODDETASIG,
            'CODDETBAJA' => $this->CODDETBAJA,
            'CODCATEGORIA' => CategoriaArticulo::find($this->CODCATEGORIA),
            'CODIGOPRESENTACION' => $this->CODIGOPRESENTACION,
            'CODIGOCONTABLE' => $this->CODIGOCONTABLE,
            'NOMBRE' => $this->NOMBRE,
            'PRECIO' => $this->PRECIO,
            'DESCRIPCION' => $this->DESCRIPCION,
            'FECHAOBTENCION' => $this->FECHAOBTENCION,
            'NSERIE' => $this->NSERIE,
            'ESTADO' => $this->ESTADO,
            'CUSTODIO' => $custodio,
        ];
    }
}
