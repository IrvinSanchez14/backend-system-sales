<?php

namespace App\Http\Controllers\TiposPagos;

use App\Http\Controllers\ApiController;
use App\TiposPagos;
use Illuminate\Http\Request;

class TiposPagosController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_pagos = TiposPagos::all();

        return $this->showAll($tipo_pagos);
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
            'nombre' => 'required',
            'siglas' => 'required',
        ];

        $this->validate($request, $rules);

        $newTipoPagos = TiposPagos::create($request->all());

        return $this->showOne($newTipoPagos, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TiposPagos $tipo_pago)
    {
        return $this->showOne($tipo_pago);
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
    public function update(Request $request, TiposPagos $tipo_pago)
    {
        $tipo_pago->fill($request->only([
            'nombre',
            'siglas',
            'status',
        ]));

        if ($tipo_pago->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $tipo_pago->save();

        return $this->showOne($tipo_pago);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiposPagos $tipo_pago)
    {
        $tipo_pago->delete();

        return $this->showOne($tipo_pago);
    }
}
