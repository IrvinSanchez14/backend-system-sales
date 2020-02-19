<?php

namespace App\Http\Controllers\RegistroCompras;

use App\Compras;
use App\Http\Controllers\ApiController;
use App\RegistroCompras;
use Illuminate\Http\Request;

class RegistroCompraSucursalController extends ApiController
{
    public function index($id)
    {
        $compras = Compras::find($id)
            ->load('compras');

        return $this->showAll($compras);
    }
}
