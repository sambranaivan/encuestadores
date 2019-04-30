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
        $areas = area::where('supervisor_id',Auth::user()->id)->get();

        return view('supervisor.areas')->with('areas',$areas);


    }
}
