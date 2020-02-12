<?php

namespace App\Http\Controllers\Cortez;

use App\Cortez;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CortezController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cortes = Cortez::all();

        return $this->showAll($cortes);
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
            'total_ventas' => 'required',
            'total_compras' => 'required',
            'total_eliminado' => 'required',
            'total_efectivo' => 'required',
            'total_pos' => 'required',
            'total_descuento' => 'required',
            'total_iva' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newCorte = Cortez::create($request->all());

        return $this->showOne($newCorte, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cortez $corte)
    {
        return $this->showOne($corte);
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
    public function update(Request $request, Cortez $corte)
    {
        $corte->fill($request->only([
            'total_ventas',
            'total_compras',
            'total_eliminado',
            'total_efectivo',
            'total_pos',
            'total_descuento',
            'total_iva',
            'status',
        ]));

        if ($corte->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $corte->save();

        return $this->showOne($corte);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cortez $corte)
    {
        $corte->delete();

        return $this->showOne($corte);
    }
}
