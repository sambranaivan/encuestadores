<?php

namespace App\Http\Controllers;
use App\area;
use App\pase;
use App\user;
use App\encuesta;
use Auth;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    //

    public function listadoAreas(){
        $areas = area::where('status','entregado')
        ->orWhere('status','recibido')
        ->orWhere('status','finalizado')
        ->orWhere('status','en supervision')->get()->sortByDesc('id');//solo las enviadas

        return view('coordinador.home')->with('areas',$areas);

    }


    public function desasignar($id)
    {
        $areas = area::find($id);
        $areas->status = 'recibido';
        $areas->save();
        return redirect()->route('homeCoordinador');
    }

    public function rechazar(request $request){
        $a = area::find($request->area_id);
        $a->status = 'rechazado';//pasa para el coordinador
        $a->save();

        $p = new pase();
        $p->area_id = $a->id;

        $p->descripcion = "Reenviado a Encuestador para control";
        $p->user_id = Auth::user()->id;
        $p->desde = Auth::user()->id;
        $p->hacia = $a->user_id;
        $p->save();
         return redirect()->route('homeCoordinador');
    }

    public function confirmar(request $request){
        $a = area::find($request->area_id);
        $a->status = 'recibido';//pasa para el coordinador
        $a->save();

        $p = new pase();
        $p->area_id = $a->id;

        $p->descripcion = "Recibido por el Coordinador";
        $p->user_id = Auth::user()->id;
        $p->hacia = Auth::user()->id;
        $p->desde = $a->user_id;
        $p->save();
         return redirect()->route('homeCoordinador');
    }

    public function asignar(request $request)
    {
        $a = area::find($request->area_id);
        $supervisores = user::where('role',1)->get();

        return view('coordinador.asignarSupervisor')->with('area',$a)->with('supervisores',$supervisores);
    }

    public function saveAsignacion(request $request)
    {
         $a = area::find($request->area_id);
        //  $s = user::find();
         $a->supervisor_id = $request->supervisor_id;
         $a->status = "en supervision";
         $a->save();

        $p = new pase();
        $p->area_id = $a->id;

        $p->descripcion = "Asignado Coordinador";
        $p->user_id = Auth::user()->id;
        $p->hacia = $request->supervisor_id;;
        $p->desde = Auth::user()->id;
        $p->save();

         return redirect()->route('homeCoordinador');

    }

    public function verArea($id){
        $a = area::find($id);

        return view('coordinador.detalleArea')->with('area',$a);
    }
    public function verEncuesta($id){
        $e = encuesta::find($id);

        return view('coordinador.detalleEncuesta')->with('encuesta',$e);
    }


}
