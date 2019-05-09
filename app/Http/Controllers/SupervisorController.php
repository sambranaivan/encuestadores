<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\pase;
use App\area;
use App\encuesta;
use App\individual;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //
    public function listadoAreas(){
        $areas = area::where('supervisor_id',Auth::user()->id)->get()->sortByDesc('id');

        return view('supervisor.areas')->with('areas',$areas);

    }

    public function verArea($id){
        $a = area::find($id);
        return view('supervisor.detalleArea')->with('area',$a);
    }

    public function finalizarArea($id)
    {
         $a = area::find($id);
        $a->status = 'finalizado';//pasa para el coordinador
        $a->save();

        $p = new pase();
        $p->area_id = $a->id;
        $p->descripcion = "Supervision Finalizada - Pase a Dirección";
        $p->user_id = Auth::user()->id;

        $p->save();

        return redirect()->route('homeSupervisor');
    }

    public function ver(request $request)
    {
        // echo "ver";
        $e = encuesta::find($request->encuesta_id);

        return view('supervisor.detalleEncuesta')->with('encuesta',$e);
    }
     public function verGet($id)
    {
        // echo "ver";
        $e = encuesta::find($id);

        return view('supervisor.detalleEncuesta')->with('encuesta',$e);
    }

     public function edit(request $request)
    {
        // echo "ver";
        $e = encuesta::find($request->encuesta_id);

        return view('supervisor.editarEncuesta')->with('area',$e->area)->with('editar',true)->with('encuesta',$e);
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
        $e->comentario_supervisor = $request->comentarios;

        $e->save();

        echo $e->id;
            // return redirect()->route('homeEncuestadores');
              return redirect('/supervisor/encuesta/'.$e->id);

    }

    public function showIndividual($id)
    {
        $e = encuesta::find($id);

        return view('supervisor.individual')->with('encuesta',$e);
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
          return redirect('/supervisor/encuesta/'.$e->id);
    }






}
