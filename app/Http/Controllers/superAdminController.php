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
                if(!$encuesta->esPobre())
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

    //

    public function edit( $id)
    {
        $e = encuesta::find($id);
        return view('superadmin.editarEncuesta')->with('area',$e->area)->with('editar',true)->with('encuesta',$e);
    }

    public function update(request $request){
        // $e = new encuesta();//
        $e = encuesta::find($request->encuesta_id);

        $e->listado = $request->listado;
        $e->vivienda = $request->vivienda;
        $e->hogar = $request->hogar;

        $e->area_id = $request->area_id;
        $e->user_id = Auth::user()->id;
        $e->estado = "en espera";
        if($request->efectiva == "efectivo")
        {
            $e->efectivo = true;
            $e->cantidad = $request->cantidad;
        }
        else if($request->efectiva == 'otro')
        {
            $e->efectivo = 2;//otro caso
            $e->otros_motivos = $request->otro_detalle;

        }
        else {
            $e->efectivo = false;
            $e->tipo_no_efectiva = $request->tipo_no_efectiva;
            switch($request->tipo_no_efectiva)
            {
                case "ausente":
                    $e->detalle_no_efectiva = $request->no_efectiva_ausente;
                break;
                case "rechazo":
                    $e->detalle_no_efectiva = $request->no_efectiva_rechazo;
                break;
                case "otros":
                $e->detalle_no_efectiva = $request->no_efectiva_otros;
                break;
            }
        }
        $e->comentario_admin = $request->comentarios;
        $e->revisado = "ok";
        $e->save();

        echo $e->id;
            // return redirect()->route('homeEncuestadores');
              return redirect('/admin/encuesta/'.$e->id);

    }


     public function listo($id)
    {
        $e = encuesta::find($id);
        $e->listo = "listo";
        $e->save();
        return redirect('/admin/encuesta/'.$e->id);

    }
      public function listoHome($id)
    {
        $e = encuesta::find($id);
        $e->listo = "listo";
        $e->save();
        return redirect()->route('homeSuperAdmin');

    }

      public function editIndividual($id){
        $i = individual::find($id);

        return view('superadmin.editIndividual')->with('individual',$i);
    }


     public function updateIndividual(request $request)
    {
            $individual = individual::find($request->id);
        //  $individual = new individual();
            $individual->user_id = Auth::user()->id;
            $individual->sexo = $request['sexo'];
            $individual->edad = $request['edad'];
            $individual->laboral = $request['laboral'];
            $individual->ingreso_laboral = $request['ingreso_laboral'];
            $individual->ingreso_no_laboral = $request['ingreso_no_laboral'];
            $individual->comentario = $request['comentario'];
            $individual->super = Auth::user()->name;
            $individual->save();
                return redirect('/admin/encuesta/'.$individual->encuesta->id);
    }
}
