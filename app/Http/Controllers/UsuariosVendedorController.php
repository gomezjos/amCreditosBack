<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuariosVendedor;

class UsuariosVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  UsuariosVendedor::get();
        return response()->json([
            "mensaje"=>"Lista de relación de usuarios por vendedor",
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
        //antes de crearlo verifico si esta
        $ruta = new UsuariosVendedor;
        $ruta->ruta_idvend = $request->ruta_idvend;
        $ruta->ruta_idusua = $request->ruta_idusua;
        //guardo la data
        $resultado = $ruta->save();

        if($resultado){
            return response()->json([
                "mensaje"=>"Se ha agregado la ruta de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No se ha podido crear la ruta",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    public function createBash(Request $request)
    {
        //$cantidad = count($request);
        foreach($request->all() as $c){
            //antes de crearlo verifico si esta
            $ruta = new UsuariosVendedor;
            $ruta->ruta_idvend = $c['ruta_idvend'];
            $ruta->ruta_idusua = $c['ruta_idusua'];
            //guardo la data
            $resultado = $ruta->save();
        }

        if($resultado){
            return response()->json([
                "mensaje"=>"Se ha agregado la ruta de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No se ha podido crear la ruta",
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ruta_idvend,$ruta_idusua)
    {
        $ruta = UsuariosVendedor::where('ruta_idvend', $ruta_idvend)
                        ->where('ruta_idusua', $ruta_idusua)
                        ->delete();
        //valido si existe
        if ($ruta) {
            return response()->json([
                "mensaje"=>"Se ha eliminado la ruta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar la ruta, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
}
