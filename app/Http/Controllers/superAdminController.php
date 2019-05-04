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
    public function home(){
        $areas = area::all();
        $count_areas = $areas->count();
        $counts = array('cargando' => 0,'en supervision'=>0,'entregado' => 0,'recibido' => 0,'en direccion' => 0,'con autorizacion' => 0);
        foreach ($areas as $area)
        {
            $counts[$area->status]++;
        }


        return view('superadmin.home',array(
                'areas'=>$areas,
                'counts'=>$counts
        ));



    }
}
