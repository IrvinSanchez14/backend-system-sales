<?php

namespace App\Http\Controllers\Compras;

use App\Compras;
use App\Http\Controllers\ApiController;
use App\RegistroCompras;
use App\Sucursal;
use Illuminate\Http\Request;

class ComprasyDetallesController extends ApiController
{
    public function index(Request $request, RegistroCompras $registro_compra)
    {
        $registro_sucursales = Sucursal::find($request->sucursal_id)
            ->load('registro')
            ->load('registro.compras')
            ->load('registro.compras.detalles');


        return $this->showOne($registro_sucursales);
    }

    public function getDetalleRegistroAll(Compras $compra)
    {
        $compras = Compras::find($compra)
            ->load('detalles')
            ->load('registro');

        return $this->showAll($compras);
    }
}
