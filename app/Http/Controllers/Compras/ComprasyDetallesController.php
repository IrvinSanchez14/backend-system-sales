<?php

namespace App\Http\Controllers\Compras;

use App\Compras;
use App\Http\Controllers\ApiController;
use App\Sucursal;

class ComprasyDetallesController extends ApiController
{
    public function index(Sucursal $sucursal)
    {
        $registro_sucursales = $sucursal
            ->load([
                'compras' => function ($query) {
                    $query->where('status', '=', 'activo');
                },
                'compras.detalles'
            ]);


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
