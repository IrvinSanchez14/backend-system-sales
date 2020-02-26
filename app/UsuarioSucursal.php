<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Sucursal;
use App\User;

class UsuarioSucursal extends Model
{
    use SoftDeletes;

    public $table = "usuario_categoria";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'usuario_id',
        'sucursal_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal', 'sucursal_id', 'id');
    }
}
