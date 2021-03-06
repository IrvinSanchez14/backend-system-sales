<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends ApiController
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
        $productos = Producto::orderBy('updated_at', 'desc')->get();

        return $this->showAll($productos);
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
            'status',
            'categoria_id' => 'required',
            'usuario_id' => 'required',
        ];

        $this->validate($request, $rules);

        $newProducto = Producto::create($request->all());
        $register_new = Producto::find($newProducto->id);

        //dd($register_new);

        return $this->showOne($register_new, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $this->showOne($producto);
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
    public function update(Request $request, Producto $producto)
    {
        $producto->fill($request->only([
            'nombre',
            'descripcion',
            'status',
            'categoria_id',
            'usuario_id',
        ]));

        if ($producto->isClean()) {
            return $this->errorResponse('Necesitas ingresar nuevos valores para poder actualizar el registro', 422);
        }

        $producto->save();

        return $this->showOne($producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return $this->showOne($producto);
    }
}
