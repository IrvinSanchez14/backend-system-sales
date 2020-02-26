<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UsuarioSucursalController extends ApiController
{
    public function index(User $user)
    {
        $usuarios_sucursales = $user->load('usuarioSucursal')->load('usuarioSucursal.sucursal');

        //dd($usuarios_sucursales);

        return $this->showOne($usuarios_sucursales);
    }
}
