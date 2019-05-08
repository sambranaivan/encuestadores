<?php

namespace App\Http\Controllers;
use App\area;
use App\encuesta;
use App\individual;
use App\pase;
use Auth;
use Illuminate\Http\Request;

class encuestadorController extends Controller
{
     //
    public function listadoAreas(){
        $areas = Auth::user()->areas;
        return view('encuestador.areas')->with('areas',$areas);
    }
    public function nuevaArea(){
        return view('encuestador.nuevaArea');
    }
    public function nuevaEncuesta(request $request){
        $area = area::find($request->area_id);
        return view('encuestador.nuevaEncuesta')->with('area',$area)->with('editar',false);
    }

    public function saveArea(request $request)
    {
        $a = new area();
        $a->area = $request->area;
        $a->anio = $request->anio;
        $a->semana = $request->semana;
        $a->trimestre = $request->trimestre;
        $a->visita = $request->visita;
        $a->user_id = Auth::user()->id;
        $a->save();

        return redirect()->route('homeEncuestadores');
    }

    public function entregarArea(request $request){
        $a = area::find($request->area_id);
        $a->status = 'entregado';//pasa para el coordinador
        $a->save();

        $p = new pase();
        $p->area_id = $a->id;
        $p->descripcion = "Entrega a Coordinacion - Espera de recepcion";
        $p->user_id = Auth::user()->id;
        $p->save();
         return redirect()->route('homeEncuestadores');
    }

    public function saveEncuesta(request $request){
        $e = new encuesta();

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
        $e->comentarios = $request->comentarios;

        $e->save();

        if($e->efectivo == 1)
        {
            return redirect("/encuesta/individuales/".$e->id);
        }
        else
        {
            return redirect()->route('homeEncuestadores');
        }


    }

    public function nuevaIndividual($id){
        $e = encuesta::find($id);

        return view('encuestador.individual')->with('encuesta',$e);
    }

    public function saveIndividuals(request $request){

        $e = encuesta::find($request->encuesta_id);
        // print_r($request->all);
        // return;
        for ($i=1; $i <= $e->cantidad ; $i++)
        {
            // echo $request['sexo_'.$i];
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
        return redirect()->route('homeEncuestadores');
    }

    public function editarEncuesta(request $request)
    {
        $e = encuesta::find($request->encuesta_id);

        return view('encuestador.editar');
    }

    public function detalleArea(request $request)
    {
        $a = area::find($request->area_id);
        return view('encuestador.detalleArea',array('area'=>$a));
    }
     public function detalleAreaGet($id)
    {
        $a = area::find($id);
        return view('encuestador.detalleArea',array('area'=>$a));
    }

    public function detalleEncuesta(request $request)
    {
        $e = encuesta::find($request->encuesta_id);
        return view('encuestador.detalleEncuesta',array('encuesta'=>$e));
    }


    public function delete(request $request)
    {
        $e = encuesta::find($request->encuesta_id);
          $a = $e->area;
          $e->delete();
          return redirect('/area/detalle/'.$a->id);
        // return redirect();
    }

    public function edit(request $request)
    {
        $e = encuesta::find($request->encuesta_id);

       return view('encuestador.nuevaEncuesta')->with('area',$e->area)->with('editar',true)->with('encuesta',$e);

    }

    public function editSave(request $request){
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
        $e->comentarios = $request->comentarios;

        $e->save();


            // return redirect()->route('homeEncuestadores');
              return redirect('/area/detalle/'.$e->area->id);



    }

    public function editIndividual($id){
        $i = individual::find($id);

        return view('encuestador.editIndividual')->with('individual',$i);
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
            $individual->save();
                return redirect('/encuesta/detalle/'.$individual->encuesta->id);
    }

    public function detalleEncuestaGet($id)
    {
        $e = encuesta::find($id);
        return view('encuestador.detalleEncuesta',array('encuesta'=>$e));
    }

}
