<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cortez extends Model
{
    use SoftDeletes;

    public $table = "cortez";

    const AVAILABLE_CORTEZ = 'activo';
    const UNAVAILABLE_CORTEZ = 'inactivo';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'total_ventas',
        'total_compras',
        'total_eliminado',
        'total_efectivo',
        'total_pos',
        'total_descuento',
        'total_iva',
        'status',
        'usuario_id'
    ];

    public function isAvailable()
    {
        return $this->status == Cortez::AVAILABLE_CORTEZ;
    }
}
