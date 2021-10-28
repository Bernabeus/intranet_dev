<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable =['CODUBICACION','CODDETASIG','CODDETBAJA','CODCATEGORIA','CODIGOPRESENTACION','CODIGOCONTABLE','NOMBRE','PRECIO','DESCRIPCION','FECHAOBTENCION','NSERIE','ESTADO'];
    protected $primaryKey = 'CODARTICULO';
    public $timestamps = false;
    protected $table = 'articulo';
}
