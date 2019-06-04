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

        return $this->inicio(1);





    }

    public function inicio($selected){
        $anio;
        $t;
        switch ($selected) {
            case 1:
                $anio = 2019;
                $t = 2;
                break;
                 case 2:
                $anio = 2019;
                $t = 1;
                break;
                 case 3:
                $anio = 2018;
                $t = 1;
                break;

            default:
                # code...
                break;
        }
        $areas = area::where('anio',$anio)->where('trimestre',$t)->get()->sortByDesc('area');

        $indicadores = app('App\Http\Controllers\EncuestaController')->getTrimestre($anio,$t);


        $e = encuesta::where('efectivo',1)->get()->sortByDesc('area_id');
        $count_areas = $areas->count();
        return view('superadmin.home',array(
                'efectivos'=>$e,
                'indicadores'=>$indicadores,
                'selected'=>$selected,
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
                //
                case "deshabitada":
                $e->detalle_no_efectiva = $request->no_efectiva_deshabitada;
                break;
                case "demolida":
                $e->detalle_no_efectiva = $request->no_efectiva_demolida;
                break;
                case "fin_de_semana":
                $e->detalle_no_efectiva = $request->no_efectiva_finde;
                break;
                case "construccion":
                $e->detalle_no_efectiva = $request->no_efectiva_construccion;
                break;
                case "establecimiento":
                $e->detalle_no_efectiva = $request->no_efectiva_establecimiento;
                break;
                case "variacion_listado":
                $e->detalle_no_efectiva = $request->no_efectiva_listado;
                break;

                //
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
            $historico->super = $individual->super;//no guradaba el cambio pajero
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
