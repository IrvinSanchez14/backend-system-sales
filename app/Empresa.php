<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'razon_social',
        'telefono',
        'status',
        'usuario_id'
    ];

    public function isAvailable()
    {
        return $this->status == Empresa::AVAILABLE_PRODUCT;
    }
}
