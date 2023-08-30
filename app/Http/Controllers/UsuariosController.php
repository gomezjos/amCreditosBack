<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Usuarios::get();
        return response()->json([
            "mensaje"=>"Lista de usuarios",
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
        $usuario = new Usuarios;
        $usuario->usua_nombre = strtoupper($request->usua_nombre);
        $usuario->usua_idperf = $request->usua_idperf;
        $usuario->usua_idempr = $request->usua_idempr;
        $usuario->usua_fecven = $request->usua_fecven;
        $usuario->usua_codigo = $request->usua_codigo;
        //solo si cambia la clave el sistema de be actualizarla
        if($request->rusua_clave !="" && $request->usua_clave != ""){
            $usuario->usua_clave = hash('sha1', $request->rusua_clave);
        }
        //guardo la data
        $resultado = $usuario->save();

        if($resultado){
            return response()->json([
                "mensaje"=>"El usuario se ha creado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El usuario no se ha podido crear, intente de nuevo más tarde",
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
        $resultado = Usuarios::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información del usuario",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El usuario buscado no se encuentra en la base de datos, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    public function login($usua_codigo,$usua_clave){
        $credenciales = ["usua_clave"=>hash('sha1',$usua_clave),"usua_codigo"=>$usua_codigo];
        //var_dump($credenciales);
        $query = Usuarios::where($credenciales);
        $sql = $query->toSql();
        //echo $sql;
        $usuario =  $query->get();
        if($usuario->count() > 0){
            return response()->json([
                "mensaje"=>"Inicio de session correcto",
                "continuar"=>1,
                "datos"=>$usuario
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El usuario o la contraseña no son correctos, por favor verifique.",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
    /**
     * Busca usuario por palabra.
     *
     * @param  \App\Models\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function search($busqueda)
    {
        $query = Usuarios::whereRaw("LOWER(usua_nombre) LIKE '%{$busqueda}%'");
        $sql = $query->toSql();
        //echo $sql;
        $usuarios =  $query->get();
        if($usuarios->count() > 0){
            return response()->json([
                "mensaje"=>"Búsqueda realizada",
                "continuar"=>1,
                "datos"=>$usuarios
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"No hay usuarios con la búsqueda realizada",
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
        $usuario = Usuarios::find($id); // o $producto = Producto::findOrFail($id);
        if ($usuario) {
            $usuario->usua_nombre = strtoupper($request->usua_nombre);
            $usuario->usua_idperf = $request->usua_idperf;
            $usuario->usua_idempr = $request->usua_idempr;
            $usuario->usua_fecven = $request->usua_fecven;
            $usuario->usua_codigo = $request->usua_codigo;
            //solo si cambia la clave el sistema de be actualizarla
            if($request->rusua_clave !="" && $request->usua_clave != ""){
                $usuario->usua_clave = hash('sha1', $request->rusua_clave);
            }
            //guardo la data
            $resultado = $usuario->save();

            if($resultado){
                return response()->json([
                    "mensaje"=>"El usuario ha sido actualizado de manera correcta",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"El usuario no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"El usuario no se encuentra en la base de datos",
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
        $usuario = Usuarios::find($id);
        if ($usuario) {
            $usuario->delete();
            return response()->json([
                "mensaje"=>"El registro se ha eliminado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar el usuario, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
}
