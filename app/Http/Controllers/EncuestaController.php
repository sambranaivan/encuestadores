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

    public function indicadores(){
       return view('superadmin.indicadores')
       ->with('a2018t4',$this->getTrimestre(2018,4))
       ->with('a2019t1',$this->getTrimestre(2019,1))
       ->with('a2019t2',$this->getTrimestre(2019,2));
    }

    public function getTrimestre($anio,$trimestre){

            $encuestas = encuesta::all();

            $filtrado = [];
            foreach ($encuestas as $en)
            {
                if($en->area->trimestre == $trimestre && $en->area->anio == $anio)
                {
                    $filtrado[] = $en;
                }
            }


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


            $p = round(sizeof($efectivos)*100/sizeof($filtrado));

            $p = round(sizeof($no_efectivos)*100/sizeof($filtrado));


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
            $p = round(sizeof($completos)*100/sizeof($efectivos));
            //   echo " ($p%)</br>";
            $p = round(sizeof($incompletos)*100/sizeof($efectivos));
            //   echo " ($p%)</br></p>";

            //POBRES nivel hogar
                $pobres = [];
                $no_pobres = [];



            // Hardord
            $_c = $completos;
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
              $pp = round((($p)*100)/($t));

              $npp = round(($np)*100/($t));



            return ['anio'=>$anio,
                'trimestre'=>$trimestre,
                "totales"=>sizeof($filtrado),
                "totalesi"=>$t,
                "efectivas"=>sizeof($efectivos),
                "noefectivas"=>sizeof($no_efectivos),

                "completos"=>sizeof($_c),
                "incompletos"=>sizeof($incompletos),

                "pobre" => sizeof($pobres),
                "nopobre" => sizeof($no_pobres),


                "individualpobre" => ($p),
                "individualnopobre" => ($np)];

    }



    public function paraPauli()
    {
         $encuestas = encuesta::all();
        $trimestre = 1;
        $anio = 2019;
            $filtrado = [];
            foreach ($encuestas as $en)
            {
                if($en->area->trimestre == $trimestre && $en->area->anio == $anio)
                {
                    $filtrado[] = $en;
                }
            }


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


            $p = round(sizeof($efectivos)*100/sizeof($filtrado));

            $p = round(sizeof($no_efectivos)*100/sizeof($filtrado));


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


            return view('pauli')->with('completos',$completos);

    }
}

