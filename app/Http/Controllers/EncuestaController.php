<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\area;
use App\encuesta;
use Auth;
class EncuestaController extends Controller
{

    public function listo($id){
        $e = encuesta::find($id);
        $e->listo = "listo";
        if($e->save())
        {
            return 'ok';
        }
        else {
            return 'error';
        }
    }

}
