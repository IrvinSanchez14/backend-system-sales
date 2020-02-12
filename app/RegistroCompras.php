<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroCompras extends Model
{
    use SoftDeletes;

    const AVAILABLE_COMPRAS_REGISTRO = 0;
    const UNAVAILABLE_COMPRAS_REGISTRO = 1;


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'status',
        'descripcion',
        'compra_id',
        'usuario_id',
        'sucursal_id'
    ];

    public function isAvailable()
    {
        return $this->status == RegistroCompras::AVAILABLE_COMPRAS_REGISTRO;
    }
}
