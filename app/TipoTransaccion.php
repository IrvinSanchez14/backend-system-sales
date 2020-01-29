<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTransaccion extends Model
{
    use SoftDeletes;

    public $table = "tipos_transaccion";

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'status',
        'usuario_id'
    ];

    public function isAvailable()
    {
        return $this->status == TipoTransaccion::AVAILABLE_PRODUCT;
    }
}
