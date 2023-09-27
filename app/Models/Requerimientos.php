<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimientos extends Model
{
    use HasFactory;
    protected $table = 'Requerimientos';
    protected $fillable = [
        'id',
        'folio',
        'tipo_requerimeinto',
        'parte',
        'area',
        'ubicacion_linea',
        'ruta',
        'cantidad_solicitada',
        'cantidad_surtida',
        'cantidad_recibida',
        'quien_solicita',
        'quien_entrega',
        'quien_recibe',
        'status',
        'ubicacion_almacen',
        'descripcion',
        'criticoCreado',
    ];
}
