<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class indicadoresController extends Controller
{
    //

    public function encuestadores(){
        $encuestadores = User::where('role',0)->get();


        return view('superadmin.encuestadores',['encuestadores'=>$encuestadores]);
    }


    public function correcciones($id)
    {
        $e = User::find($id);
        $conCambios = [];

        foreach ($e->areas as $area)
        {
            foreach ($area->encuestas as $encuesta)
            {
                foreach ($encuesta->componentes as $individual)
                {
                    // tiene algun no super?
                    if (sizeof($individual->cambiosNoSuper()))
                    {
                        $conCambios[] = $individual;
                    }
                }
            }
        }

        return view('superadmin.conCambios',['individuales'=>$conCambios]);


    }

}
