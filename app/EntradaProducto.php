<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntradaProducto extends Model
{
    use SoftDeletes;

    public $table = "entradas_productos";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'producto_id',
        'cantidad',
        'usuario_id',
        'sucursal_id',
        'transaccion_sucursal_id',
    ];

    public function productos()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }

    public function sucursales()
    {
        return $this->belongsTo('App\Sucursal', 'sucursal_id', 'id');
    }

    public function transacciones_sucursales()
    {
        return $this->belongsTo('App\TransaccionSucursal', 'transaccion_sucursal_id', 'id');
    }
}
