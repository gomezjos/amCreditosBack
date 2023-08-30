<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Empresas::get();
        return response()->json([
            "mensaje"=>"Lista de Empresas",
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
        //antes de crear la empresa debo verificar si el correo electrónico o el número de documento no existan ya
        $query = Empresas::where("empr_email",$request->empr_email)->orWhere('empr_docume', $request->empr_docume);
        $sql = $query->toSql();
        $usuarios =  $query->get();
        //si no esta creada procedo a crearla
        if($usuarios->count() == 0){

            $dataInsertar = $request->all();
            unset($dataInsertar['editar']);
            unset($dataInsertar['empr_contrasenaEmpresa']);
            unset($dataInsertar['empr_codigoAccesoR']);
            unset($dataInsertar['empr_idempr']);
            $empresa = Empresas::create($dataInsertar);
            //$empresa->fill($dataInsertar);
            //$resultado = $empresa->create($dataInsertar);
            if($empresa){
                $idEmpresaInsertada = $empresa->empr_idempr;
                //valido si envió un código de acceso y una contraseña para crearle el usuario, en caso contrario no le creo usuario
                if($request->input('empr_codigoAccesoEmpresa') != "" && $request->input('empr_contrasenaEmpresa') != ""){
                    //luego de guardar la empresa debo proceder a crear el usuario, para ellos debo usar el modelo de usuarios para crear un usuario nuevo
                    $usuario                = new Usuarios;
                    $usuario->usua_nombre   = $request->input('empr_razon');
                    $usuario->usua_codigo   = $request->input('empr_codigoAccesoEmpresa');
                    $usuario->usua_clave    = hash("sha1",$request->input('empr_contrasenaEmpresa'));
                    $usuario->usua_idempr   = $idEmpresaInsertada;
                    $usuario->usua_idperf   = 3;//perfil por defecto para el tipo de usuario de la empresa
                    $creaUsuario            = $usuario->save();
                    if($creaUsuario){
                        return response()->json([
                            "mensaje"=>"La empresa ha sido creado de manera correcta",
                            "continuar"=>1,
                            "datos"=>$idEmpresaInsertada
                        ]);
                    }
                    else{
                        return response()->json([
                            "mensaje"=>"La empresa ha sido creado de manera correcta, pero no se pudo crear el usuario",
                            "continuar"=>1,
                            "datos"=>array()
                        ]);
                    }
                }
                else{
                    return response()->json([
                        "mensaje"=>"La empresa ha sido creado de manera correcta",
                        "continuar"=>1,
                        "datos"=>$idEmpresaInsertada
                    ]);
                }


            }
            else{
                return response()->json([
                    "mensaje"=>"No se ha podido insertar la nueva empresa",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
        }
        else{
            return response()->json([
                "mensaje"=>"El correo electrónico o el número de documento ingresado ya pertenecen a una empresa creada, por favor verifique.",
                "continuar"=>0,
                "datos"=>array()
            ]);

        }
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEmpresa)
    {
        $empresa = Empresas::find($idEmpresa);

        $dataInsertar = $request->all();
        unset($dataInsertar['editar']);
        unset($dataInsertar['empr_contrasenaEmpresa']);
        unset($dataInsertar['empr_codigoAccesoR']);

        $empresa->fill($dataInsertar);
        $resultado = $empresa->save();

        if($resultado){
            //busco el usuario que le corresponda a la empresa para editarlo.
            $query          = Usuarios::where("usua_idempr", $idEmpresa);
            //$sql            = $query->toSql();
            $existeUsuario  =  $query->first();
            //dd($existeUsuario);
            //valido si hay usuario
            if($existeUsuario){//si existe le realizo un update al usuario y contraseña
                $usuarioActual = Usuarios::find($existeUsuario->usua_idusua);
                $usuarioActual->usua_nombre     = $request->input('empr_razon');
                $usuarioActual->usua_codigo     = $request->input('empr_codigoAccesoEmpresa');
                $usuarioActual->usua_clave      = hash("sha1",$request->input('empr_contrasenaEmpresa'));
                $usuarioActual->usua_idempr     = $idEmpresa;
                $usuarioActual->usua_idperf     = 3;//perfil por defecto para el tipo de usuario de la empresa
                $creaUsuario                    = $usuarioActual->save();

            }
            else{//si no existe procedo a crearlo
                $usuario                        = new Usuarios;
                $usuario->usua_nombre           = $request->input('empr_razon');
                $usuario->usua_codigo           = $request->input('empr_codigoAccesoEmpresa');
                $usuario->usua_clave            = hash("sha1",$request->input('empr_contrasenaEmpresa'));
                $usuario->usua_idempr           = $idEmpresa;
                $usuario->usua_idperf           = 3;//perfil por defecto para el tipo de usuario de la empresa
                $creaUsuario                    = $usuario->save();
                
            }

            if($creaUsuario){
                return response()->json([
                    "mensaje"=>"La empresa ha sido modificada de manera correcta",
                    "continuar"=>1,
                    "datos"=>$idEmpresa
                ]);
            }
            else{
                return response()->json([
                    "mensaje"=>"La empresa ha sido modificada de manera correcta, pero no se pudo crear el usuario",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
        }
        else{
            return response()->json([
                "mensaje"=>"No se ha podido modificar la empresa",
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
        $resultado = Empresas::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información de la empresa",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"La empresa buscada no retorna información, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }

    
     /**
     * Buscar empresa por caracter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($busqueda)
    {
        $query = Empresas::whereRaw("LOWER(empr_razon) LIKE '%{$busqueda}%'");
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
                "mensaje"=>"No hay empresas con la búsqueda realizada",
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEmpresa)
    {
        //busco el país poara luego eliminarlo
        $empresas = Empresas::find($idEmpresa);
        if ($empresas) {
            $empresas->delete();
            return response()->json([
                "mensaje"=>"El registro se ha eliminado de manera correcta",
                "continuar"=>1,
                "datos"=>array()
            ]);
        } else {
            return response()->json([
                "mensaje"=>"No se ha podido eliminar la empresa, intente de nuevo más tarde",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    }
}
