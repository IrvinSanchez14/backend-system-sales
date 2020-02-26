<?php

namespace App\Http\Controllers\SalidaProducto;

use App\Http\Controllers\ApiController;
use App\SalidaProducto;
use App\EntradaInventario;
use App\TransaccionVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalidaProductoInventarioTransaccionController extends ApiController
{
    public function store(Request $request, SalidaProducto $salidas_producto)
    {


        foreach ($request->all() as $item) {
            DB::transaction(function () use ($item, $salidas_producto) {

                if (EntradaInventario::where('id', '=', $item['inventario_id'])->exists()) {
                    $cantidad_inventario = EntradaInventario::where('id', '=', $item['inventario_id'])->first();
                    EntradaInventario::where('id', '=', $item['inventario_id'])
                        ->update(['cantidad' => $cantidad_inventario->cantidad -= $item['cantidad_vendida']]);
                }


                $transaction = TransaccionVenta::create([
                    'entrada_id' => $item['inventario_id'],
                    'producto_id' => $item['producto_id'],
                    'cantidad_anterior' => $item['cantidad_anterior'],
                    'cantidad_vendida' => $item['cantidad_vendida'],
                    'cantidad_nueva' => $item['cantidad_nueva'],
                    'precio_original' => $item['precio_original'],
                    'precio_grabado' => $item['precio_grabado'],
                    'salida_id' => $salidas_producto->id
                ]);

                //return $this->showOne($transaction, 201);
            });
        }

        return $this->showMessage('data created', 201);
    }
}
