<?php

namespace App\Http\Controllers\TransaccionSucursal;

use App\Http\Controllers\ApiController;
use App\TransaccionSucursal;
use Illuminate\Http\Request;

class TransaccionSucursalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacciones_sucursales = TransaccionSucursal::all();

        return $this->showAll($transacciones_sucursales);
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
            'cantidad' => 'required',
            'tipo_id' => 'required',
            'producto_id' => 'required',
            'sucursal_id' => 'required',
            'vendedor_id' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newTransaccionSucursal = TransaccionSucursal::create($request->all());

        return $this->showOne($newTransaccionSucursal, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaccionSucursal $transacciones_sucursale)
    {
        return $this->showOne($transacciones_sucursale);
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
    public function update(Request $request, TransaccionSucursal $transacciones_sucursale)
    {
        $transacciones_sucursale->fill($request->only([
            'cantidad',
            'tipo_id',
            'producto_id',
            'sucursal_id',
            'vendedor_id',
        ]));

        if ($transacciones_sucursale->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $transacciones_sucursale->save();

        return $this->showOne($transacciones_sucursale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaccionSucursal $transacciones_sucursale)
    {
        $transacciones_sucursale->delete();

        return $this->showOne($transacciones_sucursale);
    }
}
