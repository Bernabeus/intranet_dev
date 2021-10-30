<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaArticulo extends Model
{
    protected $fillable =['NOMBRE','PORCENTAJEDEPRECIACION','CATSUPERIOR','CODCONTABLE','CODPRESENTACION'];
    protected $primaryKey = 'CODCATEGORIA';
    public $timestamps = false;
    protected $table = 'categoria_art';
}
