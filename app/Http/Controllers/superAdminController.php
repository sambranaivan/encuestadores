<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\area;
use App\encuesta;
use App\individual;

use Illuminate\Http\Request;
class superAdminController extends Controller
{
    //

    public function verEncuesta($id)
    {
        $e = encuesta::find($id);
        return view('superadmin.detalleEncuesta')->with('encuesta',$e);
    }
    public function home(){
        $areas = area::all()->sortByDesc('area');
        $e = encuesta::where('efectivo',1)->get();
        $count_areas = $areas->count();
        $counts = array('cargando' => 0,'rechazado' => 0,'finalizado' => 0,'en supervision'=>0,'entregado' => 0,'recibido' => 0,'en direccion' => 0,'con autorizacion' => 0);
        foreach ($areas as $area)
        {
            $counts[$area->status]++;
        }

        $detalles = array(
            'totales'=>0,
            'pobres'=>0,
            'no-pobres'=>0,
            'completos'=>0,
            'incompletos'=>0,
        );
        foreach ($e as $encuesta)
        {
            $detalles['totales']++;
            if($encuesta->estado())
            {
                $detalles['completos']++;
                if($encuesta->esPobre())
                {
                    $detalles['pobres']++;
                    
                }
                else
                {
                    $detalles['no-pobres']++;
                   
                }
            }
            else
            {
                $detalles['incompletos']++;
                
            }
        }


        return view('superadmin.home',array(
                'areas'=>$areas,
                'counts'=>$counts,
                'efectivos'=>$e,
                'detalles'=>$detalles
        ));



    }
}
