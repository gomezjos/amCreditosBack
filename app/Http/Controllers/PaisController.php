<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $paises =  Pais::get();
        return response()->json([
            "mensaje"=>"Lista de paises",
            "continuar"=>1,
            "datos"=>$paises
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pais = new Pais;
        $pais->pais_nombre = strtoupper($request->pais_nombre);
        $pais->pais_codarea = $request->pais_codarea;
        $pais->pais_convenio = $request->pais_convenio;
        $resultado = $pais->save();
        if($resultado){
            return response()->json([
                "mensaje"=>"El país ha sido creado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No se ha podido insertar el pais",
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
     * Busca pais por palabra.
     *
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function search($busqueda)
    {

        $query = Pais::whereRaw("LOWER(pais_nombre) LIKE '%{$busqueda}%'");
        $sql = $query->toSql();
        //echo $sql;
        $paises =  $query->get();
        if($paises->count() > 0){
            return response()->json([
                "mensaje"=>"Búsqueda realizada",
                "continuar"=>1,
                "datos"=>$paises
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No hay paises con la búsqueda realizada",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultado = Pais::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información del país",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El id país buscado no retorna información, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPais)
    {
        $pais = Pais::find($idPais); // o $producto = Producto::findOrFail($id);
        if ($pais) {
            
            $pais->pais_nombre = strtoupper($request->pais_nombre);
            $pais->pais_codarea = $request->pais_codarea;
            $pais->pais_convenio = $request->pais_convenio;

            $resultado = $pais->save();

            if($resultado){
                return response()->json([
                    "mensaje"=>"El país ha sido actualizado de manera correcta",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"El país no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"El país no se encuentra en la base de datos",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPais)
    {
        //busco el país poara luego eliminarlo
        $pais = Pais::find($idPais);
        if ($pais) {
            $pais->delete();
            return response()->json([
                "mensaje"=>"El registro se ha eliminado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar el país, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }

    }
}
