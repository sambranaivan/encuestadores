<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\cbt;
use App\cbt_mes;
class area extends Model
{
     use SoftDeletes;
    //
    public function encuestas()
    {
        return $this->hasMany('App\encuesta');
    }

    public function isHistorico(){
        if(($this->anio == 2019 && $this->trimestre == 1) || ($this->anio == 2018) )
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function cbt(){
        $anio = $this->anio;
        $trimestre = $this->trimestre;
        $semana = $this->semana;

        $cbt = cbt::where('trimestre',$trimestre)->where('semana',$semana)->first();

        $monto = cbt_mes::where('mes',$cbt->mes)->where('anio',$anio)->first();
        if(!$monto)
        {
            $monto = cbt_mes::latest()->first();
        }
        return $monto->cbt;
    }

    public function getCompletas()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

            if($value->estado())
            {
                $c++;
            }
        }

        return $c;
    }
     public function getIncompletas()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

            if(!$value->estado())
            {
                $c++;
            }
        }

        return $c;
    }
     public function getEfectiva()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

             if(!$value->efectivo == 0)
            {
                $c++;
            }
        }

        return $c;
    }

    public function estado()
    {

            foreach ($this->encuestas as $encuesta)
            {
            if(!$encuesta->estado())
            {
            return false;
            }
            }

            return true;

    }

    public function encuestador()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

      public function getNoEfectiva()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

            if(!$value->efectivo == 0)
            {
                $c++;
            }
        }

        return $c;
    }

    public function supervisor(){
        return $this->hasOne('App\user','id','supervisor_id');
    }

     public function getOtros()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

            if(!$value->efectivo == 2)
            {
                $c++;
            }
        }

        return $c;
    }
}
