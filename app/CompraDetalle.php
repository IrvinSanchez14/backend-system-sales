<?php

namespace App;

use app\Compras;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraDetalle extends Model
{
    use SoftDeletes;

    public $table = "compra_detalles";

    const AVAILABLE_COMPRAS_DETALLE = 0;
    const UNAVAILABLE_COMPRAS_DETALLE = 1;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'codigo',
        'cantidad',
        'precio_compra',
        'precio_sugerido',
        'status',
        'producto_id',
        'compra_id'
    ];

    public function isAvailable()
    {
        return $this->status == CompraDetalle::AVAILABLE_COMPRAS_DETALLE;
    }
    public function compras()
    {
        return $this->belongsTo('App\Compras', 'compra_id', 'id');
    }
}
