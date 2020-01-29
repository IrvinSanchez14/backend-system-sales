<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalidaProducto extends Model
{
    use SoftDeletes;

    public $table = "salidas_productos";

    protected $dates = ['deleted_at'];

    const PAGO_EFECTIVO = 'efectivo';
    const PAGO_TARJETA = 'tarjeta';

    const CON_IVA = true;
    const SIN_IVA = false;

    const CLIENTE_FRECUENTO_SI = true;
    const CLIENTE_FRECUENTE_NO = false;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'tipo_pago',
        'cliente_frecuente',
        'sin_iva',
        'valor_venta',
        'valor_iva',
        'no_factura',
        'usuario_id',
        'sucursal_id',
    ];

    public function tipoPago()
    {
        return $this->tipo_pago == SalidaProducto::PAGO_EFECTIVO;
    }

    public function extentoIva()
    {
        return $this->sin_iva == SalidaProducto::CON_IVA;
    }

    public function clienteFrecuente()
    {
        return $this->cliente_frecuente == SalidaProducto::CLIENTE_FRECUENTE_NO;
    }


    public function productos()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }


    public function sucursales()
    {
        return $this->belongsTo('App\Sucursal', 'sucursal_id', 'id');
    }
}
