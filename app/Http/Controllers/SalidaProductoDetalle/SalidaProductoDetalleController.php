<?php

namespace App\Http\Controllers\SalidaProductoDetalle;

use App\Http\Controllers\ApiController;
use App\SalidaProductoDetalles;
use Illuminate\Http\Request;

class SalidaProductoDetalleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salida_detalles = SalidaProductoDetalles::all();

        return $this->showAll($salida_detalles);
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
            'precio_original' => 'required',
            'precio_grabado' => 'required',
            'salida_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newSalidaDetalle = SalidaProductoDetalles::create($request->all());

        return $this->showOne($newSalidaDetalle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SalidaProductoDetalles $salida_detalle)
    {
        return $this->showOne($salida_detalle);
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
    public function update(Request $request, SalidaProductoDetalles $salida_detalle)
    {
        $salida_detalle->fill($request->only([
            'producto_id',
            'precio_original',
            'precio_grabado',
            'status',
            'salida_id',
        ]));

        if ($salida_detalle->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $salida_detalle->save();

        return $this->showOne($salida_detalle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalidaProductoDetalles $salida_detalle)
    {
        $salida_detalle->delete();

        return $this->showOne($salida_detalle);
    }
}
