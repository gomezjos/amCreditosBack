<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu =  Menu::get();
        return response()->json([
            "mensaje"=>"Lista de opciones del menú",
            "continuar"=>1,
            "datos"=>$menu
        ]);
    }
    public function getMenuUser($idUsuario){

        $query = Menu::leftJoin('gen_permisos', function ($join) use ($idUsuario) {
            $join->on('gen_permisos.perm_idmenu', '=', 'sys_menu.menu_idmenu');
        })->where('gen_permisos.perm_idusua', $idUsuario)->orderBy("sys_menu.menu_idmenu","ASC");

        $menu = $query->get();

        //$menu =  Menu::get();
        return response()->json([
            "mensaje"=>"Lista de opciones del menú",
            "continuar"=>1,
            "datos"=>$menu
        ]);
    }

    public function getMenuConPermisos($idUsuario){

        $query = Menu::leftJoin('gen_permisos', function ($join) use ($idUsuario) {
                        $join->on('gen_permisos.perm_idmenu', '=', 'sys_menu.menu_idmenu')
                        ->where('gen_permisos.perm_idusua', $idUsuario);
        })->orderBy("sys_menu.menu_idmenu","ASC");
        $resultado = $query->get();
        

        return response()->json([
            "mensaje"=>"Lista de opciones del menú asignados al usuario",
            "continuar"=>1,
            "datos"=>$resultado
        ]);
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
    public function destroy($id)
    {
        //
    }
}
