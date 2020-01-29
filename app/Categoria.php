<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Producto;

class Categoria extends Model
{
    use SoftDeletes;

    public $table = "categorias";

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
        return $this->status == Categoria::AVAILABLE_PRODUCT;
    }

    public function productos()
    {
        return $this->hasOne('App\Producto', 'categoria_id', 'categoria_id');
    }
}
