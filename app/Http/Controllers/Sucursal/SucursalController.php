<?php

namespace App\Http\Controllers\Sucursal;

use App\Http\Controllers\ApiController;
use App\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::all();

        return $this->showAll($sucursales);
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
            'telefono' => 'required',
            'direccion' => 'required',
            'empresa_id' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newSucursal = Sucursal::create($request->all());

        return $this->showOne($newSucursal, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sucursal = Sucursal::find($id);
        return $this->showOne($sucursal);
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
    public function update(Request $request, $id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->fill($request->only([
            'nombre',
            'telefono',
            'direccion',
            'empresa_id',
        ]));

        if ($sucursal->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $sucursal->save();

        return $this->showOne($sucursal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->delete();

        return $this->showOne($sucursal);
    }
}
