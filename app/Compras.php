<?php

namespace App;

use app\CompraDetalle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compras extends Model
{
    use SoftDeletes;

    public $table = "compras";

    const AVAILABLE_COMPRAS = 'activo';
    const UNAVAILABLE_COMPRAS = 'inactivo';

    const TIPO_NUEVO = 'nuevo';
    const TIPO_USADO = 'usado';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'lote',
        'codigo',
        'cantidad',
        'precio_compra',
        'precio_sugerido',
        'tipo_compra',
        'status',
        'producto_id',
        'sucursal_id',
        'usuario_id'
    ];

    public function isAvailable()
    {
        return $this->status == Compras::AVAILABLE_COMPRAS;
    }

    public function detalles()
    {
        return $this->hasMany('App\CompraDetalle', 'compra_id', 'id');
    }

    public function registro()
    {
        return $this->hasOne('App\RegistroCompras', 'compra_id', 'id');
    }
}
