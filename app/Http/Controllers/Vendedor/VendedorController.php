<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\ApiController;
use App\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores = Vendedor::all();

        return $this->showAll($vendedores);
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
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newVendedor = Vendedor::create($request->all());

        return $this->showOne($newVendedor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedore)
    {

        return $this->showOne($vendedore);
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
    public function update(Request $request, Vendedor $vendedore)
    {
        $vendedore->fill($request->only([
            'nombre',
            'telefono',
            'direccion',
        ]));

        if ($vendedore->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $vendedore->save();

        return $this->showOne($vendedore);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedore)
    {
        $vendedore->delete();

        return $this->showOne($vendedore);
    }
}
