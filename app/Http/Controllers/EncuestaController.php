<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\area;
use App\encuesta;
use App\individual;
use Auth;
use DB;
class EncuestaController extends Controller
{

    public function listo($id)
    {
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

    //

    public function historico($id)
    {
        $e = encuesta::find($id);
        return view('superadmin.historicos')->with('encuesta',$e);
    }


    public function modificaciones($id)
    {
        $i = individual::find($id);
        return view('superadmin.modificaciones')->with('individual',$i);

    }

    public function indicadores($anio,$trimestre){

            //   $encuestas = encuesta::where('efectivo',1)->get();//me traigo todas las encuestas
            $areas = area::where('trimestre',$trimestre)->where('anio',$anio);

            $encuestas = DB::table('encuestas')//encuestas
            ->leftJoin('areas','encuestas.area_id','=','areas.id')
            ->where('areas.trimestre',$trimestre)
            ->where('areas.anio',$anio)->get();
            // $encuestas = encuesta::hydrate($encuestas);

            echo "Totales: ".$encuestas->count()."</br>";

            //EFECTIVOS y //NO EFECTIVOS

                                                                                $efectivos = [];
                                                                                $no_efectivos = [];

            foreach ($encuestas as $e)
            {
                if($e->efectivo)
                {
                    $efectivos[] = $e;
                }
                else
                {
                    $no_efectivos[] = $e;
                }
            }

            echo "Efectivas: ".sizeof($efectivos)."</br>";
            echo "No Efectivas: ".sizeof($no_efectivos)."</br>";

            //COMPLETOS

                                                                                $completos = [];
                                                                                $incompletos = [];

            //INCOMPLETOS & FALTA MONTOS
            foreach ($efectivos as $e)
            {

                ///hydrate
                $e = encuesta::find($e->id);
                if($e->estado())//completo
                {
                    $completos[] = $e;
                }
                else
                {
                    $incompletos[] = $e;
                }
            }
            echo "Completos: ".sizeof($completos)."</br>";
            echo "Incompletos: ".sizeof($incompletos)."</br>";

            //POBRES nivel hogar
                                                                                $pobres = [];
                                                                                $no_pobres = [];

            foreach ($completos as $c)
            {
                if($e->esPobre())
                {
                    $pobres[] = $e;
                }
                else
                {
                    $no_pobres[] = $e;
                }
            }
            echo "Pobreza nivel Hogar: Pobres ".sizeof($pobres)." No Pobres ".sizeof($no_pobres);





            //POBREZA INDIVIDUAL
            $t = 0;
            $p = 0;
            $np = 0;
            foreach ($completos as $c)
            {
                foreach ($c->componentes as $i)
                {
                    $t++;
                    if($i->esPobre())
                    {
                        $p++;
                    }
                    else
                    {
                        $np++;
                    }
                }
            }
            echo "</br>";
            echo "Pobreza nivel Individuo: Pobres ".$p." No Pobres ".$np;







    }

}
