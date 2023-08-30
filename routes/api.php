<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\CiudadesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\TiposDocController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RazonSocialController;
use App\Http\Controllers\UsuariosVendedorController;
use App\Http\Controllers\DesempenoController;
use App\Http\Controllers\VentasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:api')->get('/login', function (Request $request) {
//     return $request->user();
// });

//login del usuario
Route::middleware('cors')->get('/login/{usua_codigo}/{usua_clave}',[UsuariosController::class, 'login'])->middleware('cors');
Route::middleware('cors')->post('/logout',[LoginController::class, 'logout'])->middleware('cors');

//rutas para el país
Route::middleware('cors')->get('/paises',[PaisController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/paises/{idPais}',[PaisController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/paises/buscar/{busqueda}',[PaisController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/paises',[PaisController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/paises/{idPais}',[PaisController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/paises/{idPais}',[PaisController::class, 'destroy'])->middleware('cors');

//rutas del apí de ciudades
Route::middleware('cors')->get('/ciudades',[CiudadesController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/ciudades/{idPais}',[CiudadesController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/ciudades/buscar/{busqueda}',[CiudadesController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/ciudades',[CiudadesController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/ciudades/{idPais}',[CiudadesController::class, 'update'])->middleware('cors');
Route::middleware('cors')->get('/ciudades/ciudadPorPais/{idPais}',[CiudadesController::class, 'ciudadPorPais'])->middleware('cors');
Route::middleware('cors')->delete('/ciudades/{idPais}',[CiudadesController::class, 'destroy'])->middleware('cors');

//Rutas para los perfiles
Route::middleware('cors')->get('/perfiles',[PerfilesController::class, 'index'])->middleware('cors');
//rutas para los tipos de documentos
Route::middleware('cors')->get('/tiposDocumento',[TiposDocController::class, 'index'])->middleware('cors');
//empresas asignadas. Modulo empresas
Route::middleware('cors')->get('/razonSocial',[RazonSocialController::class, 'index'])->middleware('cors');

//rutas para el menú principal
Route::middleware('cors')->get('/menu',[MenuController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/menu/{idUsuario}',[MenuController::class, 'getMenuUser'])->middleware('cors');//menú por usuario
Route::middleware('cors')->get('/menu/permisosUsuario/{idUsuario}',[MenuController::class, 'getMenuConPermisos'])->middleware('cors');

//rutas para los usuarios
Route::middleware('cors')->get('/usuarios',[UsuariosController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/usuarios/{idPais}',[UsuariosController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/usuarios/buscar/{busqueda}',[UsuariosController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/usuarios',[UsuariosController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/usuarios/{idPais}',[UsuariosController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/usuarios/{idPais}',[UsuariosController::class, 'destroy'])->middleware('cors');

//rutas para el manejo de las empresas
Route::middleware('cors')->get('/empresas',[EmpresasController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/empresas/{idEmpresa}',[EmpresasController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/empresas/buscar/{busqueda}',[EmpresasController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/empresas',[EmpresasController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/empresas/{idEmpresa}',[EmpresasController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/empresas/{idEmpresa}',[EmpresasController::class, 'destroy'])->middleware('cors');

//permisos
Route::middleware('cors')->get('/permisos',[PermisosController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/permisos/permisosUsuario/{perm_idusua}',[PermisosController::class, 'permisosUsuario'])->middleware('cors');
Route::middleware('cors')->post('/permisos',[PermisosController::class, 'store'])->middleware('cors');
Route::middleware('cors')->get('/permisos/getPermisosModuloUsuario/{idUsuario}/{idModulo}',[PermisosController::class, 'getPermisosModuloUsuario'])->middleware('cors');

//rutas para los vendedores
Route::middleware('cors')->get('/vendedores',[VendedoresController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/vendedores/{idVendedor}',[VendedoresController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/vendedores/buscar/{busqueda}',[VendedoresController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/vendedores',[VendedoresController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/vendedores/{idVendedor}',[VendedoresController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/vendedores/{idVendedor}',[VendedoresController::class, 'destroy'])->middleware('cors');
Route::middleware('cors')->get('/vendedores/vendedoresPais/{idUsuario}',[VendedoresController::class, 'arbolVendedores'])->middleware('cors');



//rutas para los clientes
Route::middleware('cors')->get('/clientes/max',[ClientesController::class, 'max'])->middleware('cors');
Route::middleware('cors')->get('/clientes',[ClientesController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/clientes/{idCliente}',[ClientesController::class, 'show'])->middleware('cors');
Route::middleware('cors')->post('/clientes/buscar',[ClientesController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/clientes',[ClientesController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/clientes/{idCliente}',[ClientesController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/clientes/{idCliente}',[ClientesController::class, 'destroy'])->middleware('cors');

//rutas para las ventas
Route::middleware('cors')->put('/ventas/{idVenta}',[VentasController::class, 'update'])->middleware('cors');

//rutas para productos
Route::middleware('cors')->get('/productos',[ProductosController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/productos/{idCliente}',[ProductosController::class, 'show'])->middleware('cors');
Route::middleware('cors')->get('/productos/buscar/{busqueda}',[ProductosController::class, 'search'])->middleware('cors');
Route::middleware('cors')->post('/productos',[ProductosController::class, 'create'])->middleware('cors');
Route::middleware('cors')->put('/productos/{idCliente}',[ProductosController::class, 'update'])->middleware('cors');
Route::middleware('cors')->delete('/productos/{idCliente}',[ProductosController::class, 'destroy'])->middleware('cors');


//rutas de los vendedores y el usuario
Route::middleware('cors')->post('/rutas',[UsuariosVendedorController::class, 'create'])->middleware('cors');
Route::middleware('cors')->post('/rutas/bash',[UsuariosVendedorController::class, 'createBash'])->middleware('cors');
Route::middleware('cors')->delete('/rutas/{ruta_idvend}/{ruta_idusua}',[UsuariosVendedorController::class, 'destroy'])->middleware('cors');

//rutas para las apis de las gráficas
Route::middleware('cors')->get('/desempeno',[DesempenoController::class, 'index'])->middleware('cors');
Route::middleware('cors')->get('/desempeno/cant/{idVendedor}/{anio}',[DesempenoController::class, 'cantidadVentas'])->middleware('cors');
Route::middleware('cors')->get('/desempeno/tot/{idVendedor}/{anio}',[DesempenoController::class, 'totalVentas'])->middleware('cors');