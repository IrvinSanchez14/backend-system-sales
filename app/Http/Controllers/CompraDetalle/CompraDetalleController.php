<?php

namespace App\Http\Controllers\CompraDetalle;

use App\CompraDetalle;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompraDetalleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra_detalles = CompraDetalle::all();

        return $this->showAll($compra_detalles);
    }

    public function onlyToday()
    {
        $compras = CompraDetalle::whereDate('created_at', Carbon::now()->format('Y-m-d'))
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
        foreach ($request->all() as $item) {

            CompraDetalle::create($item);
        }

        return $this->showMessage('data created', 201);

        /*$rules = [
            'codigo' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required',
            'precio_sugerido' => 'required',
            'producto_id' => 'required',
            'compra_id' => 'required'
        ];
        $this->validate($request, $rules);


        $newCompraDetalle = CompraDetalle::create($request->all());

        return $this->showOne($newCompraDetalle, 201);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CompraDetalle $compra_detalle)
    {
        return $this->showOne($compra_detalle);
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
    public function update(Request $request, CompraDetalle $compra_detalle)
    {
        $compra_detalle->fill($request->only([
            'codigo',
            'cantidad',
            'precio_compra',
            'precio_sugerido',
            'status',
            'producto_id',
            'compra_id'
        ]));

        if ($compra_detalle->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $compra_detalle->save();

        return $this->showOne($compra_detalle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraDetalle $compra_detalle)
    {
        $compra_detalle->delete();

        return $this->showOne($compra_detalle);
    }
}
