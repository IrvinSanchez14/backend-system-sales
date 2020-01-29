<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaccionProducto extends Model
{
    use SoftDeletes;

    public $table = "transacciones_productos";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'producto_id',
        'tipo_id',
        'valor_nuevo',
        'valor_anterior',
        'comentario',
        'usuario_id',
    ];

    public function productos()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }

    public function tipos()
    {
        return $this->belongsTo('App\TipoTransaccion', 'tipo_id', 'id');
    }
}
