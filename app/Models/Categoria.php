<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable =['NOMBRE','PORCDEPRECIACION','CATSUPERIOR','CODCONTABLE','CODPRESENTACION'];
    protected $primaryKey = 'CODCATEGORIA';
    public $timestamps = false;
    protected $table = 'categoria';
}
