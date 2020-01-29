<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    public $table = "productos";

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    const OFERTA_DISPONIBLE = true;
    const OFERTA_FAIL = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_sugerido',
        'status',
        'oferta_flag',
        'categoria_id',
        'usuario_id',
    ];

    public function isAvailable()
    {
        return $this->status == Producto::AVAILABLE_PRODUCT;
    }

    public function isOferta()
    {
        return $this->oferta_flag == Producto::AVAILABLE_PRODUCT;
    }

    public function categorias()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }
}
