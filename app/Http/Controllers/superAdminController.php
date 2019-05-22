<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\area;
use App\encuesta;
use App\individual;
use App\historico;
use App\historico_e;

use Illuminate\Http\Request;
class superAdminController extends Controller
{
    //

    public function verEncuesta($id)
    {
        $e = encuesta::find($id);
        return view('superadmin.detalleEncuesta')->with('encuesta',$e);
    }

    public function deleteIndividual($id)
    {
        $i = individual::find($id)    ;
        $e = $i->encuesta_id;
        $i->delete();

        return redirect('/admin/encuesta/'.$e);
    }


    public function home(){
        // solo la de ESTE cuatrimestre
        $areas = area::all()->sortByDesc('area');


        $e = encuesta::where('efectivo',1)->get()->sortByDesc('area_id');
        $count_areas = $areas->count();
        echo $e->count();
        $detalles = array(
            'totales'=>0,
            'pobres'=>0,
            'no-pobres'=>0,
            'completos'=>0,
            'incompletos'=>0,
        );
        foreach ($e as $encuesta)
        {
           if(!$encuesta->isHistorico())
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
        }

        $historicos = [];
        $actuales = [];
        foreach ($areas as $a) {
            if($a->isHistorico())
            {
                $historicos[] = $a;
            }
            else
            {
                $actuales[] = $a;
            }
        }



        return view('superadmin.home',array(
                'areas'=>$actuales,
                // 'counts'=>$counts,
                'efectivos'=>$e,
                'detalles'=>$detalles,
                'historicos'=>$historicos,
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
          // save historico
        $h = new historico_e();
            $h->encuesta_id = $e->id;
            $h->user_id = Auth::user()->id;
            $h->listado = $e->listado;
            $h->cantidad = $e->cantidad;
            $h->vivienda = $e->vivienda;
            //
            $h->efectivo = $e->efectivo;
            //$h->montos_completos = $e->//$h->montos_completos;
            //
            $h->tipo_no_efectiva = $e->tipo_no_efectiva;
            $h->detalle_no_efectiva = $e->detalle_no_efectiva;

            $h->estado = $e->estado;

            $h->comentarios = $e->comentarios;
            $h->revision = $e->revision;
            $h->hogar = $e->hogar;
            $h->otros_motivos = $e->otros_motivos;
            $h->supersuper = $e->supersuper;
            $h->comentario_supervisor = $e->comentario_supervisor;
            $h->comentario_admin = $e->comentario_admin;
            $h->revisado = $e->revisado;
            $h->listo = $e->listo;
        $h->save();

        // end historico

        $e->listado = $request->listado;
        $e->vivienda = $request->vivienda;
        $e->hogar = $request->hogar;

        $e->area_id = $request->area_id;
        // $e->user_id = Auth::user()->id;//no cambio el dueño de la encuesta
        $e->estado = "revisada";
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
            // un historico de cambios aca
            $historico = new historico();
            $historico->individual_id = $individual->id;
            $historico->sexo = $individual->sexo;
            $historico->edad = $individual->edad;
            $historico->laboral = $individual->laboral;
            $historico->ingreso_laboral = $individual->ingreso_laboral;
            $historico->ingreso_no_laboral = $individual->ingreso_no_laboral;
            $historico->comentario = $individual->comentario;
            $historico->user_id = Auth::user()->id;
            $historico->save();
        //  $individual = new individual();
            // $individual->user_id = Auth::user()->id;/no cambio el dueño orginal de la encuesta
            $individual->sexo = $request['sexo'];
            $individual->edad = $request['edad'];
            $individual->laboral = $request['laboral'];
            $individual->ingreso_laboral = $request['ingreso_laboral'];
            $individual->ingreso_no_laboral = $request['ingreso_no_laboral'];
            $individual->comentario = $request['comentario'];
            if( $request['super'] == 'on')
            {

                $individual->super = Auth::user()->name;
            }
            $individual->save();



                return redirect('/admin/encuesta/'.$individual->encuesta->id);
    }

    public function showIndividual($id)
    {
        $e = encuesta::find($id);

        return view('superadmin.individual')->with('encuesta',$e);
    }

      public function saveIndividual(request $request)
    {

        $e = encuesta::find($request->encuesta_id);
        for ($i=1; $i <= $e->cantidad ; $i++)
        {

            $individual = new individual();
            $individual->user_id = Auth::user()->id;
            $individual->encuesta_id = $e->id;
            $individual->sexo = $request['sexo_'.$i];
            $individual->edad = $request['edad_'.$i];
            $individual->laboral = $request['laboral_'.$i];
            $individual->ingreso_laboral = $request['ingreso_laboral_'.$i];
            $individual->ingreso_no_laboral = $request['ingreso_no_laboral_'.$i];
            $individual->save();
        }
          return redirect('/admin/encuesta/'.$e->id);
    }
}
