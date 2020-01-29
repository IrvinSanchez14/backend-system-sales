<?php

namespace App\Http\Controllers\TipoTransaccion;

use App\Http\Controllers\ApiController;
use App\TipoTransaccion;
use Illuminate\Http\Request;

class TipoTransaccionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_transaccion = TipoTransaccion::all();

        return $this->showAll($tipos_transaccion);
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
            'descripcion' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newTipoTransaccion = TipoTransaccion::create($request->all());

        return $this->showOne($newTipoTransaccion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoTransaccion $tipos_transaccion)
    {
        return $this->showOne($tipos_transaccion);
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
    public function update(Request $request, TipoTransaccion $tipos_transaccion)
    {
        $tipos_transaccion->fill($request->only([
            'nombre',
            'descripcion',
        ]));

        if ($tipos_transaccion->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $tipos_transaccion->save();

        return $this->showOne($tipos_transaccion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoTransaccion $tipos_transaccion)
    {
        $tipos_transaccion->delete();

        return $this->showOne($tipos_transaccion);
    }
}
