<?php

namespace App\Http\Controllers\EntradaInventario;

use App\EntradaInventario;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class EntradaInventarioController extends ApiController
{
    public function store(Request $request)
    {
        foreach ($request->all() as $item) {

            EntradaInventario::create($item);
        }

        return $this->showMessage('data created', 201);

        /*$rules = [
            'codigo' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required',
            'precio_sugerido' => 'required',
            'producto_id' => 'required',
            'compra_id' => 'required'
        ];
        $this->validate($request, $rules);


        $newCompraDetalle = CompraDetalle::create($request->all());

        return $this->showOne($newCompraDetalle, 201);*/
    }
}
