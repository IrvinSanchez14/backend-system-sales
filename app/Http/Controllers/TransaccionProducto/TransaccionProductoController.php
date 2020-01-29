<?php

namespace App\Http\Controllers\TransaccionProducto;

use App\Http\Controllers\ApiController;
use App\TransaccionProducto;
use Illuminate\Http\Request;

class TransaccionProductoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacciones_productos = TransaccionProducto::all();

        return $this->showAll($transacciones_productos);
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
            'producto_id' => 'required',
            'tipo_id' => 'required',
            'valor_nuevo' => 'required',
            'valor_anterior' => 'required',
            'comentario' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newTransaccionProducto = TransaccionProducto::create($request->all());

        return $this->showOne($newTransaccionProducto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaccionProducto $transacciones_producto)
    {
        return $this->showOne($transacciones_producto);
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
    public function update(Request $request, TransaccionProducto $transacciones_producto)
    {
        $transacciones_producto->fill($request->only([
            'producto_id',
            'tipo_id',
            'valor_nuevo',
            'valor_anterior',
            'comentario',
        ]));

        if ($transacciones_producto->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $transacciones_producto->save();

        return $this->showOne($transacciones_producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaccionProducto $transacciones_producto)
    {
        $transacciones_producto->delete();

        return $this->showOne($transacciones_producto);
    }
}
