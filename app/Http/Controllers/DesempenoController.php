<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;

class DesempenoController extends Controller
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
    public function cuentaCantTotal($mes,$idVendedor,$anio){
        if($idVendedor == 0){//muestro todas las ventas
            $query      = Ventas::whereRaw("EXTRACT(MONTH FROM vent_fecha) = ".$mes)->whereRaw("EXTRACT(YEAR FROM vent_fecha) = ".$anio);
        }
        else{//muestro solo las del vendedor
            $query      = Ventas::whereRaw("EXTRACT(MONTH FROM vent_fecha) = ".$mes)->whereRaw("EXTRACT(YEAR FROM vent_fecha) = ".$anio)->where("vent_idvend",$idVendedor);
        }
        $cantidad   = $query->count();
        return $cantidad;
    }
    public function cuentaSumaTotal($mes,$idVendedor,$anio){
        if($idVendedor == 0){//muestro todas las ventas
            $query      = Ventas::whereRaw("EXTRACT(MONTH FROM vent_fecha) = ".$mes)->whereRaw("EXTRACT(YEAR FROM vent_fecha) = ".$anio);
        }
        else{//muestro solo las del vendedor
            $query      = Ventas::whereRaw("EXTRACT(MONTH FROM vent_fecha) = ".$mes)->whereRaw("EXTRACT(YEAR FROM vent_fecha) = ".$anio)->where("vent_idvend",$idVendedor);
        }
        $suma   = $query->sum('vent_valor');
        return $suma;
    }
    public function cantidadVentas(Request $request,$idVendedor,$anio){
        $cantidad = 0;
        $salida = array();
        for($a=1;$a<=12;$a++){
            $cant = $this->cuentaCantTotal($a,$idVendedor,$anio);
            array_push($salida,$cant);
        }
        return $salida;
    }
    public function totalVentas(Request $request,$idVendedor,$anio){
        $cantidad = 0;
        $salida = array();
        for($a=1;$a<=12;$a++){
            $cant = $this->cuentaSumaTotal($a,$idVendedor,$anio);
            array_push($salida,$cant);
        }
        return $salida;
    }
}
