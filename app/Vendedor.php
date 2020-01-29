<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendedor extends Model
{
    use SoftDeletes;

    public $table = "vendedores";

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'status',
        'usuario_id',
    ];

    public function isAvailable()
    {
        return $this->status == Vendedor::AVAILABLE_PRODUCT;
    }
}
