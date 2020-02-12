<?php

namespace App\Http\Controllers\RegistroCompras;

use App\Http\Controllers\ApiController;
use App\RegistroCompras;
use Illuminate\Http\Request;

class RegistroComprasController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registro_compras = RegistroCompras::all();

        return $this->showAll($registro_compras);
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
            'descripcion' => 'required',
            'compra_id' => 'required',
            'usuario_id' => 'required',
            'sucursal_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newRegistroCompras = RegistroCompras::create($request->all());

        return $this->showOne($newRegistroCompras, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroCompras $registro_compra)
    {
        return $this->showOne($registro_compra);
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
    public function update(Request $request, RegistroCompras $registro_compra)
    {
        $registro_compra->fill($request->only([
            'status',
            'descripcion',
            'compra_id',
            'usuario_id',
            'sucursal_id'
        ]));

        if ($registro_compra->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $registro_compra->save();

        return $this->showOne($registro_compra);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroCompras $registro_compra)
    {
        $registro_compra->delete();

        return $this->showOne($registro_compra);
    }
}
