<?php

namespace App\Http\Controllers\SalidaProducto;

use App\Http\Controllers\ApiController;
use App\SalidaProducto;
use Illuminate\Http\Request;

class SalidaProductoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidas = SalidaProducto::all();

        return $this->showAll($salidas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'valor_venta' => 'required',
            'valor_iva' => 'required',
            'no_factura' => 'required',
            'usuario_id' => 'required',
            'sucursal_id' => 'required',
            'tipo_pago_id' => 'required'
        ];

        $this->validate($request, $rules);

        $newSalida = SalidaProducto::create($request->all());

        return $this->showOne($newSalida, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SalidaProducto $salidas_producto)
    {
        return $this->showOne($salidas_producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalidaProducto $salidas_producto)
    {
        $salidas_producto->fill($request->only([
            'cliente_frecuente',
            'sin_iva',
            'valor_venta',
            'valor_iva',
            'no_factura',
            'usuario_id',
            'sucursal_id',
            'tipo_pago_id'
        ]));

        if ($salidas_producto->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $salidas_producto->save();

        return $this->showOne($salidas_producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalidaProducto $salidas_producto)
    {
        $salidas_producto->delete();

        return $this->showOne($salidas_producto);
    }
}
