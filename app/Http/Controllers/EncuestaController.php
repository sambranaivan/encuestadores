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

            $indi = 0;
            foreach ($filtrado as $e)
            {
                $e = encuesta::find($e->id);
                $indi += $e->componentes->count();
                if($e->efectivo)
                {
                    $efectivos[] = $e;
                }
                else
                {
                    $no_efectivos[] = $e;
                }
            }


            echo "<p>Efectivas: ".sizeof($efectivos)."/".sizeof($filtrado);
            $p = round(sizeof($efectivos)*100/sizeof($filtrado));
            echo " ($p%)</br>";

            echo "No Efectivas: ".sizeof($no_efectivos)."/".sizeof($filtrado);
            $p = round(sizeof($no_efectivos)*100/sizeof($filtrado));
            echo " ($p%)</br></p>";


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
            echo "<p>Completos: ".sizeof($completos)."/".sizeof($efectivos);
            $p = round(sizeof($completos)*100/sizeof($efectivos));
              echo " ($p%)</br>";
            echo "Incompletos: ".sizeof($incompletos)."/".sizeof($efectivos);
            $p = round(sizeof($incompletos)*100/sizeof($efectivos));
              echo " ($p%)</br></p>";

            //POBRES nivel hogar
                                                                                $pobres = [];
                                                                                $no_pobres = [];



            // Hardord
            $completos = $efectivos;
            foreach ($completos as $c)
            {
                if($c->esPobre() == false)
                {
                    $pobres[] = $c;
                }
                else
                {
                    $no_pobres[] = $c;
                }
            }

            $hpo = round(sizeof($pobres)*100/sizeof($completos));
            $hnpo = round(sizeof($no_pobres)*100/sizeof($completos));

            echo "Pobreza nivel Hogar:</br>Pobres: ".sizeof($pobres)."/".sizeof($completos)." ($hpo%)".
            " </br> No Pobres: ".sizeof($no_pobres)."/".sizeof($completos)." ($hnpo%)";





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
            echo "<p>";
              $pp = round((($p)*100)/($t));

              $npp = round(($np)*100/($t));
            echo "Pobreza nivel Individuo:</br>Pobres: $p/$t ($pp%) </br> No Pobres: $np/$t ($npp%)";
                echo "</p>";

                echo "<p>Total Individuales: $indi</p>";







    }

}
