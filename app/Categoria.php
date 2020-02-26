<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Producto;
use App\User;

class Categoria extends Model
{
    use SoftDeletes;

    public $table = "categorias";

    const AVAILABLE_PRODUCT = 'disponible';
    const UNAVAILABLE_PRODUCT = 'no disponible';

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
    public function users()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function products()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
