<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $fillable =['CODTRANSFERENCIA','FECHA'];
    protected $primaryKey = 'CODTRANSFERENCIA';
    public $timestamps = false;
    protected $table = 'transferencia';
}
