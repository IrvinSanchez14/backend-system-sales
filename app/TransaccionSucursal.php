<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaccionSucursal extends Model
{
    use SoftDeletes;

    public $table = "transacciones_sucursales";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cantidad',
        'tipo_id',
        'producto_id',
        'sucursal_id',
        'vendedor_id',
        'usuario_id',
    ];

    public function tipos()
    {
        return $this->belongsTo('App\TipoTransaccion', 'tipo_id', 'id');
    }

    public function productos()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }

    public function sucursales()
    {
        return $this->belongsTo('App\Sucursal', 'sucursal_id', 'id');
    }

    public function vendedores()
    {
        return $this->belongsTo('App\Vendedor', 'vendedor_id', 'id');
    }
}
