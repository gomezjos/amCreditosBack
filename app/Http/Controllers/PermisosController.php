<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permisos;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //var_dump($request->all());die();
        //echo $request->perm_idmenu;die();
        //busco el permisos que intento guardar
        $query   =  Permisos::where('perm_idmenu', $request->perm_idmenu)->where('perm_idusua',$request->perm_idusua);
        $permiso = $query->first();
        $sql = $query->toSql();
        if($permiso){//si existe procedo a actualizar
            // $permiso->perm_idmenu   = $request->perm_idmenu;
            // $permiso->perm_idusua   = $request->perm_idusua;
            // $permiso->guardar       = $request->guardar;
            // $permiso->buscar        = $request->buscar;
            // $permiso->eliminar      = $request->eliminar;
            //actualizo
            $permiso->fill($request->all());
            $resultado     = $permiso->save();
            if($resultado){
                return response()->json([
                    "mensaje"=>"Se ha actualizado el permiso sobre el módulo seleccionado",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"No se han podido actualizar los permisos sobre el módulo, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
        }
        else{//proceso a insertar
            $permiso = new Permisos;
            // $permiso->perm_idmenu   = $request->perm_idmenu;
            // $permiso->perm_idusua   = $request->perm_idusua;
            // $permiso->guardar       = $request->guardar;
            // $permiso->buscar        = $request->buscar;
            // $permiso->eliminar      = $request->eliminar;
            //actualizo
            $permiso->fill($request->all());
            $resultado   = $permiso->save();
            if($resultado){
                return response()->json([
                    "mensaje"=>"Se ha guardado el permiso sobre el módulo seleccionado",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"No se han podido guardado el permiso sobre el módulo, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
        }
    }

    public function getPermisosModuloUsuario($perm_idusua,$perm_idmenu){
        $filtro     = ["perm_idmenu"=>$perm_idmenu,"perm_idusua"=>$perm_idusua];
        $query    =  Permisos::where($filtro);
        $permiso =  $query->get();
        if($permiso){
            return response()->json([
                "mensaje"=>"Permisos del módulo",
                "continuar"=>1,
                "datos"=>$permiso
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No hay permisos para este modulo",
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
    public function show($id)
    {
        //
    }


    public function permisosUsuario($id)
    {
        
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
    public function destroy($id)
    {
        //
    }
}
