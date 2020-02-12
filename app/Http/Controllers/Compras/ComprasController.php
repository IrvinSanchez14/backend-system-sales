<?php

namespace App\Http\Controllers\Compras;

use App\Compras;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComprasController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compras::all();

        return $this->showAll($compras);
    }

    public function onlyToday()
    {
        $compras = Compras::whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->get();

        return $this->showAll($compras);
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
            'lote' => 'required',
            'tipo_compra' => 'required',
            'sucursal_id' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newCompra = Compras::create($request->all());

        return $this->showOne($newCompra, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Compras $compra)
    {
        return $this->showOne($compra);
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
    public function update(Request $request, Compras $compra)
    {
        $compra->fill($request->only([
            'lote',
            'tipo_compra',
            'sucursal_id',
            'usuario_id',
        ]));

        if ($compra->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $compra->save();

        return $this->showOne($compra);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compras $compra)
    {
        $compra->delete();

        return $this->showOne($compra);
    }
}
