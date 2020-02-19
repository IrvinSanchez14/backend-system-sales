<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{

    use SoftDeletes;
    public $table = "sucursales";

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'status',
        'empresa_id',
        'usuario_id',
    ];

    public function isAvailable()
    {
        return $this->status == Sucursal::AVAILABLE_PRODUCT;
    }

    public function empresas()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id', 'id');
    }

    public function compras()
    {
        return $this->hasMany('App\Compras', 'sucursal_id', 'id');
    }

    public function registro()
    {
        return $this->hasMany('App\RegistroCompras', 'sucursal_id', 'id');
    }
}
