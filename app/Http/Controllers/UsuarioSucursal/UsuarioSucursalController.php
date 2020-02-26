<?php

namespace App\Http\Controllers\UsuarioSucursal;

use App\Http\Controllers\ApiController;
use App\UsuarioSucursal;
use Illuminate\Http\Request;

class UsuarioSucursalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        /* $this->middleware('auth:api')
            ->only(['index']);*/
    }

    public function index()
    {
        $usuarios_sucursales = UsuarioSucursal::orderBy('updated_at', 'desc')->get();

        return $this->showAll($usuarios_sucursales);
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
            'usuario_id' => 'required',
            'sucursal_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newUsuerSuc = UsuarioSucursal::create($request->all());
        //$register_new = Producto::find($newProducto->id);

        //dd($register_new);

        return $this->showOne($newUsuerSuc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioSucursal $usuario_sucursal)
    {
        return $this->showOne($usuario_sucursal);
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
    public function update(Request $request, UsuarioSucursal $usuario_sucursal)
    {
        $usuario_sucursal->fill($request->only([
            'usuario_id',
            'sucursal_id',
        ]));

        if ($usuario_sucursal->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $usuario_sucursal->save();

        return $this->showOne($usuario_sucursal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioSucursal $usuario_sucursal)
    {
        $usuario_sucursal->delete();

        return $this->showOne($usuario_sucursal);
    }
}
