<?php

namespace App\Http\Controllers;
use App\area;
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
        return view('encuestador.nuevaEncuesta')->with('area',$area);
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
         return redirect()->route('homeEncuestadores');
    }

    public function saveEncuesta(request $request){
        print_r ($request->efectivo);
    }


}
