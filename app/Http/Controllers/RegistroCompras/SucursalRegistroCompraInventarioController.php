<?php

namespace App\Http\Controllers\RegistroCompras;

use App\Http\Controllers\ApiController;
use App\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalRegistroCompraInventarioController extends ApiController
{
    public function index(Sucursal $sucursale)
    {
        DB::enableQueryLog();
        $sucursal = Sucursal::find($sucursale->id);

        $sucursales = $sucursal
            ->load([
                'registro' => function ($query) {
                    $query->where('status', '=', 0);
                },
                'registro.inventario' => function ($query) {
                    $query->where('cantidad', '!=', 0);
                },
                'registro.inventario.producto:id,nombre'
            ]);

        /* $books->load(['author' => function ($query) {
                $query->orderBy('published_date', 'asc');
            }]);*/
        //dd($sucursales);
        // Enable query log

        // Your Eloquent query executed by using get()

        //dd(DB::getQueryLog()); // Show results of log

        return $this->showOne($sucursales);
    }
}
