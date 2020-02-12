<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TiposPagos extends Model
{
    use SoftDeletes;

    const AVAILABLE_TIPO_PAGOS = 0;
    const UNAVAILABLE_TIPO_PAGOS = 1;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'siglas',
        'status',
    ];

    public function isAvailable()
    {
        return $this->status == TiposPagos::AVAILABLE_TIPO_PAGOS;
    }
}
