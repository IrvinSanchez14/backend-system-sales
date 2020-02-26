<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Producto extends Model
{
    use SoftDeletes;

    public $table = "productos";

    const AVAILABLE_PRODUCT = 'disponible';
    const UNAVAILABLE_PRODUCT = 'no disponible';

    const OFERTA_DISPONIBLE = true;
    const OFERTA_FAIL = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'status',
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
    public function users()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
