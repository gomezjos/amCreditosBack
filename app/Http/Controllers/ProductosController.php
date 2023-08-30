<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Productos::get();
        return response()->json([
            "mensaje"=>"Lista de productos",
            "continuar"=>1,
            "datos"=>$datos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataInserta    = $request->all();
        //guardo la data
        $cliente = Productos::create($dataInserta);
        if($cliente){
            return response()->json([
                "mensaje"=>"El producto ha sido creado de manera correcta",
                "continuar"=>1,
                "datos"=>''
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El producto no se ha podido crear, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultado = Productos::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información del producto",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El producto buscado no se encuentra en la base de datos, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
    /**
    * Busca producto por palabra.
    *
    * @param  $busqueda
    * @return \Illuminate\Http\Response
    */
   public function search($busqueda)
   {
       $query = Productos::whereRaw("LOWER(prod_nombre) LIKE '%{$busqueda}%'");
       $sql = $query->toSql();
       //echo $sql;
       $resultado =  $query->get();
       if($resultado->count() > 0){
           return response()->json([
               "mensaje"=>"Búsqueda realizada",
               "continuar"=>1,
               "datos"=>$resultado
           ]);
       }
       else{
           return response()->json([
               "mensaje"=>"No hay productos con la búsqueda realizada",
               "continuar"=>0,
               "datos"=>array()
           ]);
       }
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
    public function update(Request $request, $idProducto)
    {
        $producto = Productos::find($idProducto); // o $producto = Producto::findOrFail($id);
        if($producto) {
            $producto->fill($request->all());
            //guardo la data
            $resultado = $producto->save();
            if($resultado){
                return response()->json([
                    "mensaje"=>"El producto ha sido modificada de manera correcta",
                    "continuar"=>1,
                    "datos"=>$idProducto
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"El producto no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"El producto no se encuentra en la base de datos",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //busco el país poara luego eliminarlo
        $cliente = Productos::find($id);
        //valido si existe
        if ($cliente) {
            //borro el registro
            $borrado = $cliente->delete();
            return response()->json([
                "mensaje"=>"El registro se ha eliminado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar el vendedor, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
}
