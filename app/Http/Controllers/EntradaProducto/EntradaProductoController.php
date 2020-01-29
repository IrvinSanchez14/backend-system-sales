<?php

namespace App\Http\Controllers\EntradaProducto;

use App\EntradaProducto;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class EntradaProductoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas_productos = EntradaProducto::all();

        return $this->showAll($entradas_productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'producto_id' => 'required',
            'cantidad' => 'required',
            'usuario_id' => 'required',
            'sucursal_id' => 'required',
            'transaccion_sucursal_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newEntradaProducto = EntradaProducto::create($request->all());

        return $this->showOne($newEntradaProducto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EntradaProducto $entradas_producto)
    {
        return $this->showOne($entradas_producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, EntradaProducto $entradas_producto)
    {
        $entradas_producto->fill($request->only([
            'producto_id',
            'cantidad',
            'sucursal_id',
            'transaccion_sucursal_id',
        ]));

        if ($entradas_producto->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $entradas_producto->save();

        return $this->showOne($entradas_producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntradaProducto $entradas_producto)
    {
        $entradas_producto->delete();

        return $this->showOne($entradas_producto);
    }
}
