<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use Illuminate\Http\Request;

class CiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Ciudades::get();
        return response()->json([
            "mensaje"=>"Lista de ciudades",
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
        $ciudad = new Ciudades;
        $ciudad->ciud_idpais = $request->ciud_idpais;
        $ciudad->ciud_nombre = strtoupper($request->ciud_nombre);
        $ciudad->ciud_gmt = $request->ciud_gmt;
        $resultado = $ciudad->save();
        if($resultado){
            return response()->json([
                "mensaje"=>"La ciudad ha sido creado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No se ha podido insertar la nueva ciudad",
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
        $resultado = Ciudades::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información de la ciudad",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"La ciudad buscada no retorna información, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
    /**
     * Muestra las ciudades según el país.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ciudadPorPais($idPais)
    {
        $resultado = Ciudades::where("ciud_idpais",$idPais)->orderBy('ciud_nombre', 'asc')->get(); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información de la ciudad",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"La ciudad buscada no retorna información, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($busqueda)
    {
        $query = Ciudades::whereRaw("LOWER(ciud_nombre) LIKE '%{$busqueda}%'");
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
                "mensaje"=>"No hay ciudades con la búsqueda realizada",
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
    public function update(Request $request, $id)
    {
        $ciudad = Ciudades::find($id); // o $producto = Producto::findOrFail($id);
        if ($ciudad) {
            $ciudad->ciud_idpais = $request->ciud_idpais;
            $ciudad->ciud_nombre = strtoupper($request->ciud_nombre);
            $ciudad->ciud_gmt = $request->ciud_gmt;
            $resultado = $ciudad->save();
            if($resultado){
                return response()->json([
                    "mensaje"=>"La ciudad ha sido actualizada de manera correcta",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"La ciudad no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"La ciudad no se encuentra en la base de datos",
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
        $ciudad = Ciudades::find($id);
        if ($ciudad) {
            $ciudad->delete();
            return response()->json([
                "mensaje"=>"El registro se ha eliminado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar la ciudad, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
}
