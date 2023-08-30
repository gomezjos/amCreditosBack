<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedores;
use App\Models\Usuarios;
use App\Models\Pais;
use App\Models\Ciudades;
use App\Models\UsuariosVendedor;

class VendedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos =  Vendedores::get();
        return response()->json([
            "mensaje"=>"Lista de vendedores",
            "continuar"=>1,
            "datos"=>$datos
        ]);
    }

    public function arbolVendedores($idUsuario){
        //primero consulto todos los paises
        $salida = array();
        $paises =  Pais::get()->toArray();
        $cont = 0;
        foreach($paises as $p){
            $salida[$cont]['idpais'] = $p['pais_idpais'];
            $salida[$cont]['pais'] = $p['pais_nombre'];
            //luego consulto cada ciudad por pais
            $ciudades = Ciudades::where(['ciud_idpais'=>$p['pais_idpais']])->orderBy("ciud_nombre")->get();
            //si hay ciudades procedo
            if($ciudades){
                $salidaCiudad = array();
                $contadorC    = 0;
                foreach($ciudades as $c){
                    //finalmente consulto los vendedores de ese país y esa ciudad
                    $vendedores = Vendedores::where(['vend_idpais'=>$p['pais_idpais'],"vend_idciud"=>$c['ciud_idciud']])->get();
                    if($vendedores){
                        $contadorV = 0;
                        $salidaVendedores = array();
                        foreach($vendedores as $v){
                            //consulto en la relación si el vendedor está con el usuario
                            $relacion       = UsuariosVendedor::where(['ruta_idvend'=>$v['vend_idvend'],'ruta_idusua'=>$idUsuario])->get();
                            $existeRelacion =  $relacion->first();

                            $salidaVendedores[$contadorV]['idVendedor'] = $v['vend_idvend'];
                            $salidaVendedores[$contadorV]['activo']     = ($existeRelacion) ? 1 : 0 ;
                            $salidaVendedores[$contadorV]['idRelacion'] = ($existeRelacion) ? $existeRelacion['ruta_idruta'] : 0 ;
                            $salidaVendedores[$contadorV]['vendedor']   = $v['vend_nombres']." ".$v['vend_apellidos'];
                            $contadorV ++;
                        }
                        if(count($salidaVendedores) > 0)
                        {
                            $salidaCiudad[$contadorC]['idciudad'] = $c['ciud_idciud'];
                            $salidaCiudad[$contadorC]['ciudad'] = $c['ciud_nombre'];
                            $salidaCiudad[$contadorC]['vendedores'] = $salidaVendedores;
                            $contadorC++;
                        }
                    }
                }
                $salida[$cont]['ciudades']   = $salidaCiudad;
            }
            $cont++;
        }

        
        return response()->json([
            "mensaje"=>"Lista de paises",
            "continuar"=>1,
            "datos"=>$salida
        ]);
        //luego busco la relación del usuario con los vendedores que puede ver y señalo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataInserta    = $request->all();
        unset($dataInserta['vend_idvend']);
        unset($dataInserta['vend_codigoaccesoR']);
        //guardo la data
        $vendedor = Vendedores::create($dataInserta);
        if($vendedor){
            //capturo el id que acabo de insertar del vendedor
            $vendedorInsertado = $vendedor->vend_idvend;
            if($request->input('vend_codigoacceso') != ""){
                $usuario                = new Usuarios;
                $usuario->usua_nombre   = $request->input('vend_nombres')." ".$request->input('vend_apellidos');
                $usuario->usua_codigo   = $request->input('vend_codigoacceso');
                $usuario->usua_clave    = hash("sha1",env('CLAVE_DEFECTO_VENDEDORES'));//contraseña por defecto de los vendedores. //@see .env
                $usuario->usua_idven    = $vendedorInsertado;
                $usuario->usua_fecven   = $request->input('vend_fecha');
                $usuario->usua_idperf   = 4;//perfil por defecto administrador para los vendedores
                $creaUsuario            = $usuario->save();
                if($creaUsuario){
                    return response()->json([
                        "mensaje"=>"El vendedor ha sido creado de manera correcta",
                        "continuar"=>1,
                        "datos"=>$vendedorInsertado
                    ]);
                }
                else{
                    return response()->json([
                        "mensaje"=>"El vendedor ha sido creado de manera correcta, pero no se pudo crear el usuario de acceso",
                        "continuar"=>1,
                        "datos"=>array()
                    ]);
                    }
            }
            else{
                return response()->json([
                    "mensaje"=>"El vendedor se ha creado de manera correcta",
                    "continuar"=>1,
                    "datos"=>array()
                ]);
            }
        }
        else{
            return response()->json([
                "mensaje"=>"El vendedor no se ha podido crear, intente de nuevo más tarde",
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
        $resultado = Vendedores::find($id); 
        if($resultado){
            return response()->json([
                "mensaje"=>"Información del vendedor",
                "continuar"=>1,
                "datos"=>$resultado
            ]);
        }
        else{
            return response()->json([
                "mensaje"=>"El vendedor buscado no se encuentra en la base de datos, verifique e intente de nuevo",
                "continuar"=>0,
                "datos"=>array()
            ]);
        }
    } 
    
    /**
    * Busca vendedor por palabra.
    *
    * @param  \App\Models\pais  $pais
    * @return \Illuminate\Http\Response
    */
   public function search($busqueda)
   {
       $query = Vendedores::whereRaw("LOWER(vend_nombres) LIKE '%{$busqueda}%' OR LOWER(vend_apellidos) LIKE '%{$busqueda}%'");
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
               "mensaje"=>"No hay vendedores con la búsqueda realizada",
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
    public function update(Request $request, $idVendedor)
    {
        $vendedor = Vendedores::find($idVendedor); // o $producto = Producto::findOrFail($id);
        if($vendedor) {
            $vendedor->fill($request->all());
            //guardo la data
            $resultado = $vendedor->save();
            if($resultado){
                //busco el usuario que le corresponda a la empresa para editarlo.
                $query                              = Usuarios::where("usua_idven", $idVendedor);
                //$sql                              = $query->toSql();
                $existeUsuario                      =  $query->first();
                //dd($existeUsuario);
                //valido si hay usuario
                if($existeUsuario){//si existe le realizo un update al usuario y contraseña
                    $usuarioActual                  = Usuarios::find($existeUsuario->usua_idusua);
                    $usuarioActual->usua_nombre     = $request->input('vend_nombres')." ".$request->input('vend_apellidos');
                    $usuarioActual->usua_codigo     = $request->input('vend_codigoacceso');
                    //$usuarioActual->usua_clave      = hash("sha1",env('CLAVE_DEFECTO_VENDEDORES'));
                    $usuarioActual->usua_idven      = $idVendedor;
                    $usuarioActual->usua_idperf     = 4;//perfil por defecto para el tipo de usuario de la empresa
                    $creaUsuario                    = $usuarioActual->save();

                }
                else{//si no existe procedo a crearlo
                    $usuario                        = new Usuarios;
                    $usuario->usua_nombre           = $request->input('vend_nombres')." ".$request->input('vend_apellidos');
                    $usuario->usua_codigo           = $request->input('vend_codigoacceso');
                    $usuario->usua_clave            = hash("sha1",env('CLAVE_DEFECTO_VENDEDORES'));//@see .env
                    $usuario->usua_idven            = $idVendedor;
                    $usuario->usua_idperf           = 4;//perfil por defecto para el tipo de usuario de la empresa
                    $creaUsuario                    = $usuario->save();
                    
                }

                if($creaUsuario){
                    return response()->json([
                        "mensaje"=>"El vendedor ha sido modificada de manera correcta",
                        "continuar"=>1,
                        "datos"=>$idVendedor
                    ]);
                }
                else{
                    return response()->json([
                        "mensaje"=>"El vendedor ha sido modificado de manera correcta, pero no se pudo crear el usuario",
                        "continuar"=>1,
                        "datos"=>array()
                    ]);
                }


            }
            else{
                return response()->json([
                    "mensaje"=>"El vendedor no se ha podido actualizar, intente de nuevo más tarde",
                    "continuar"=>0,
                    "datos"=>array()
                ]);
            }
            
        } else {
            // Maneja el caso en el que el producto no sea encontrado
            return response()->json([
                "mensaje"=>"El vendedor no se encuentra en la base de datos",
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
        $vendedor = Vendedores::find($id);
        //busco también si existe usuario creado en la tabla de usuarios
        $filtro     = ["usua_idven"=>$id];
        $usuarioVendedor = Usuarios::where($filtro);
        if ($vendedor) {
            $borradoVendedor = $vendedor->delete();
            if($usuarioVendedor && $borradoVendedor){//si existe el usuario del vendedor y se ha borrado el vendedor procedo a eliminar el usuario también
                $borradoUsuario = $usuarioVendedor->delete();
            }
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
