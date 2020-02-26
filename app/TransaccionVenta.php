<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaccionVenta extends Model
{
    use SoftDeletes;

    public $table = "transaccion_venta";

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'entrada_id',
        'producto_id',
        'cantidad_anterior',
        'cantidad_vendida',
        'cantidad_nueva',
        'precio_original',
        'precio_grabado',
        'salida_id'
    ];


    public function productos()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }
}
