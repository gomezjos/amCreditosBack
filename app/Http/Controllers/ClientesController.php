<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Clientes::get();
        return response()->json([
            "mensaje"=>"Lista de clientes",
            "continuar"=>1,
            "datos"=>$datos
        ]);
    }

    public function max()
    {
        $max =  Clientes::max('clien_idclien');
        if($max){
            return response()->json([
                "mensaje"=>"Consecutivo de cliente actual",
                "continuar"=>1,
                "datos"=>($max + 1)
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No hay clientes creados. Consecutivo inicial será 0",
                "continuar"=>1,
                "datos"=>1
            ]);
        }
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
        $cliente = Clientes::create($dataInserta);
        if($cliente){
            return response()->json([
                "mensaje"=>"El cliente ha sido creado de manera correcta",
                "continuar"=>1,
                "datos"=>''
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El cliente no se ha podido crear, intente de nuevo más tarde",
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
        $resultado = Clientes::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información del cliente",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El cliente buscado no se encuentra en la base de datos, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
    /**
    * Busca cliente por palabra.
    *
    * @param  $busqueda
    * @return \Illuminate\Http\Response
    */
   public function search(Request $request)
   {
        $busquedaOr = " clien_idclien > 0 ";
        //ajusto los filtros de busqueda
        if($request->consecutivoBuscar != ""){
            $busquedaOr .= " AND gen_clientes.clien_idclien = '%{$request->consecutivoBuscar}%'";
        }
        if($request->documentoBuscar != ""){
            $busquedaOr .= " AND gen_clientes.clien_docume = '%{$request->documentoBuscar}%'";
        }
        if($request->nombresBuscar != ""){
            $busquedaOr .= " AND LOWER(gen_clientes.clien_nombres) LIKE '%{$request->nombresBuscar}%'";
        }
        if($request->apellidosBuscar != ""){
            $busquedaOr .= " AND LOWER(gen_clientes.clien_apellidos) LIKE '%{$request->apellidosBuscar}%'";
        }
        if($request->vendedorBuscar != 0){
            $busquedaOr .= " AND gen_ventas.vent_idvend = '{$request->vendedorBuscar}'";
        }
        if($request->fechaVenta != ''){
            $busquedaOr .= " AND gen_ventas.vent_fecha >= '{$request->fechaVenta}' AND gen_ventas.vent_fecha <= '{$request->fechaVenta}'";
        }

        $query = Clientes::join('gen_ventas', 'gen_clientes.clien_idclien', '=', 'gen_ventas.vent_idclien')
        ->join('gen_vendedores','gen_ventas.vent_idvend', '=','gen_vendedores.vend_idvend')->whereRaw($busquedaOr);

        $sql = $query->toSql();
        //echo $sql;
        $clientes =  $query->get();
        //valido si hay resultados
        if($clientes->count() > 0){
            return response()->json([
                "mensaje"=>"Búsqueda realizada",
                "continuar"=>1,
                "datos"=>$clientes
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No hay información con los parámetros enviados.",
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
    public function update(Request $request, $idCliente)
    {
        $cliente = Clientes::find($idCliente); // o $producto = Producto::findOrFail($id);
        if($cliente) {
            $cliente->fill($request->all());
            //guardo la data
            $resultado = $cliente->save();
            if($resultado){
                return response()->json([
                    "mensaje"=>"El cliente ha sido modificada de manera correcta",
                    "continuar"=>1,
                    "datos"=>$idCliente
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"El cliente no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"El cliente no se encuentra en la base de datos",
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
        $cliente = Clientes::find($id);
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
