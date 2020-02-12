<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalidaProductoDetalles extends Model
{
    use SoftDeletes;

    const AVAILABLE_DETALLES = 0;
    const UNAVAILABLE_DETALLES = 1;

    public $table = "salidas_productos_detalles";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'producto_id',
        'precio_original',
        'precio_grabado',
        'status',
        'salida_id',
    ];

    public function isAvailable()
    {
        return $this->status == SalidaProductoDetalles::AVAILABLE_DETALLES;
    }
}
