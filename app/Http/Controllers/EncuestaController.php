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


            $encuestas = encuesta::all();

            $filtrado = [];
            foreach ($encuestas as $en)
            {
                if($en->area->trimestre == $trimestre && $en->area->anio == $anio)
                {
                    $filtrado[] = $en;
                }
            }

            echo "Totales: ".sizeof($filtrado)."</br>";

            //EFECTIVOS y //NO EFECTIVOS

                                                                                $efectivos = [];
                                                                                $no_efectivos = [];

            foreach ($filtrado as $e)
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

            echo "Efectivas: ".sizeof($efectivos)."/".$encuestas->count()."</br>";
            echo "No Efectivas: ".sizeof($no_efectivos)."/".$encuestas->count()."</br>";

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
            echo "Completos: ".sizeof($completos)."/".sizeof($efectivos)."</br>";
            echo "Incompletos: ".sizeof($incompletos)."/".sizeof($efectivos)."</br>";

            //POBRES nivel hogar
                                                                                $pobres = [];
                                                                                $no_pobres = [];

            foreach ($completos as $c)
            {
                if($c->esPobre() == true)
                {
                    $pobres[] = $c;
                }
                else
                {
                    $no_pobres[] = $c;
                }
            }
            echo "Pobreza nivel Hogar: Pobres ".sizeof($pobres)."/".sizeof($completos)."No Pobres ".sizeof($no_pobres)."/".sizeof($completos);





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
            echo "Pobreza nivel Individuo: Pobres $p/$t No Pobres $np/$t";







    }

}
