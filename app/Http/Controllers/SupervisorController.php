<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\pase;
use App\area;

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
        $p->descripcion = "Supervision Finalizada - Pase a coordinacion";
        $p->user_id = Auth::user()->id;

        $p->save();

        return redirect()->route('homeSupervisor');
    }
}
