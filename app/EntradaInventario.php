<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntradaInventario extends Model
{
    use SoftDeletes;

    public $table = "entrada_inventario";

    const AVAILABLE_COMPRAS_REGISTRO = 0;
    const UNAVAILABLE_COMPRAS_REGISTRO = 1;


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'cantidad',
        'precio_sugerido',
        'producto_id',
        'registro_id'
    ];

    public function registroCompra()
    {
        return $this->belongsTo('App\RegistroCompras', 'registro_id', 'id');
    }
    public function producto()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }
}
