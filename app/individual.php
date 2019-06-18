<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class individual extends Model
{
        use SoftDeletes;

    public function historico(){
        return $this->hasMany('App\historico');
    }


    public function encuesta()
    {
        return $this->belongsTo('App\encuesta');
    }
    //
    public function getMonts()
    {

        $laboral = $this->ingreso_laboral?$this->ingreso_laboral:0;
        $no_laboral = $this->ingreso_no_laboral?$this->ingreso_no_laboral:0;
        if($laboral == -9 || $no_laboral == -9){
            return -9;
        }

        return $laboral + $no_laboral;
    }

    public function getPond(){
        if($this->sexo = "M")
        {
           if($this->edad <= 0)
           {
               return 0.35;
           }
           elseif ($this->edad == 1) {
                return 0.37;
           }
           elseif ($this->edad == 2) {
                return 0.46;
           }
           elseif ($this->edad == 3) {
                return 0.51;
           }
           elseif ($this->edad == 4) {
                return 0.55;
           }
           elseif ($this->edad == 5) {
                return 0.60;
           }
           elseif ($this->edad == 6) {
                return 0.64;
           }
           elseif ($this->edad == 7) {
                return 0.66;
           }
           elseif ($this->edad == 8) {
                return 0.68;
           }
           elseif ($this->edad == 9) {
                return 0.69;
           }
           elseif ($this->edad == 10) {
                return 0.70;
           }
           elseif ($this->edad == 11) {
                return 0.72;
           }
           elseif ($this->edad == 12) {
                return 0.74;
           }
           elseif ($this->edad == 13) {
                return 0.76;
           }
           elseif ($this->edad == 14) {
                return 0.76;
           }
           elseif ($this->edad == 15) {
                return 0.77;
           }
           elseif ($this->edad == 16) {
                return 0.77;
           }
           elseif ($this->edad == 17) {
                return 0.77;
           }
           elseif ($this->edad >= 18 && $this->edad <= 29)
           {
                return 0.76;
           }
           elseif ($this->edad >= 30 && $this->edad <= 45)
           {
                return 0.77;
           }
           elseif ($this->edad >= 46 && $this->edad <= 60)
           {
                return 0.76;
           }
           elseif ($this->edad >= 61 && $this->edad <= 75)
           {
                return 0.67;
           }
           elseif ($this->edad > 75)
           {
                return 0.63;
           }
        }
        else
        {
            // HOMBRE
            if($this->edad <= 0)
           {
               return 0.35;
           }
           elseif ($this->edad == 1) {
                return 0.37;
           }
           elseif ($this->edad == 2) {
                return 0.46;
           }
           elseif ($this->edad == 3) {
                return 0.51;
           }
           elseif ($this->edad == 4) {
                return 0.55;
           }
           elseif ($this->edad == 5) {
                return 0.60;
           }
           elseif ($this->edad == 6) {
                return 0.64;
           }
           elseif ($this->edad == 7) {
                return 0.66;
           }
           elseif ($this->edad == 8) {
                return 0.68;
           }
           elseif ($this->edad == 9) {
                return 0.69;
           }
           elseif ($this->edad == 10) {
                return 0.79;
           }
           elseif ($this->edad == 11) {
                return 0.82;
           }
           elseif ($this->edad == 12) {
                return 0.85;
           }
           elseif ($this->edad == 13) {
                return 0.90;
           }
           elseif ($this->edad == 14) {
                return 0.96;
           }
           elseif ($this->edad == 15) {
                return 1;
           }
           elseif ($this->edad == 16) {
                return 1.03;
           }
           elseif ($this->edad == 17) {
                return 1.04;
           }
           elseif ($this->edad >= 18 && $this->edad <= 29)
           {
                return 1.02;
           }
           elseif ($this->edad >= 30 && $this->edad <= 45)
           {
                return 1;
           }
           elseif ($this->edad >= 46 && $this->edad <= 60)
           {
                return 1;
           }
           elseif ($this->edad >= 61 && $this->edad <= 75)
           {
                return 0.83;
           }
           elseif ($this->edad > 75)
           {
                return 0.74;
           }
        }
    }


    public function estado(){


        if($this->getMonts() == -9)
        {
          return false;
        }

        if($this->laboral == 'Trabaja' && ($this->ingreso_laboral <0 || is_null($this->ingreso_laboral)))
        {
            return false;//aca falta el coso
        }
        else {
            return true;
        }
    }


    public function fueSuper()
    {
        $h = $this->historico;


        foreach ($h as $histo)
        {
            if($histo->esSuper()){
                return true;
            }
        }

        return false;
    }

    public function cambiosNoSuper(){
         $h = $this->historico;
         $r = [];///array vacio

        foreach ($h as $histo)
        {
            if(!$histo->esSuper()){
                $r[] = $histo;
            }
        }

        return $r;

    }

    public function hasCambios(){
        if($this->historico->count())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function modificado3(){
        $h = $this->historico;


        foreach ($h as $histo)
        {
            if($histo->who->role == 3)
            {
                return true;
            }
        }

        return false;
    }



    public function esPobre()
    {
        $ingreso_individual_del_hogar = $this->encuesta->ingreso_individual();

        $minimo = $this->getPond() * $ingreso_individual_del_hogar;

        if($minimo < $this->encuesta->cbt())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // indificar tipos de cambios

    public function errorType()
    {
        ///obtengo mi ultimo cambio
        if($this->historico->count() == 0)
        {
            return 'sin cambios';
        }


        $h = $this->historico[0];
        //

        /**
         * Reglas de comparacion
         */

        // cambios en ingreso laboral
        if($h->ingreso_laboral != $this->ingreso_laboral)
        {
            // si era -9 y ahora es un monto x
            if( ($h->ingreso_laboral < 0 || is_null($h->ingreso_laboral)) && $this->ingreso_laboral > 0)
            {
                return "(Territorio) Recuperacion de Ingreso Laboral";
            }
            elseif ($h->ingreso_laboral > 0 && ($h->ingreso_laboral != $this->ingreso_laboral))
            {
                return "(S/P) Correccion de Ingreso Laboral";
            }
        }
        // Cambions ne ingresos no Laborales
        if($h->ingreso_no_laboral != $this->ingreso_no_laboral)
        {
            // si era -9 y ahora es un monto x
            if(($h->ingreso_no_laboral < 0 || is_null($h->ingreso_no_laboral) ) && $this->ingreso_no_laboral > 0)
            {
                return "(Territorio) Recuperacion de Ingreso no Laboral";
            }
            elseif ($h->ingreso_no_laboral > 0 && ($h->ingreso_no_laboral != $this->ingreso_no_laboral))
            {
                return "(S/P) Correccion de Ingreso Laboral";
            }
        }
        // Cambio de sexo
        if($h->sexo != $this->sexo)
        {
            return "(S/P) Correccion de Sexo";
        }
        // Cambio en Edad
        if($h->edad != $this->edad)
        {
            return "(S/P) Correccion de Edad";
        }

        //sin cambios
        if($h->edad == $this->edad &&
            $h->sexo == $this->sexo &&
            $h->ingreso_no_laboral == $this->ingreso_no_laboral &&
            $h->ingreso_laboral == $this->ingreso_laboral)
        {
            return 'sin cambios';
        }


    }


    /**
     * Quien Corrigio la encuesta?
     */
    public function getCorrector()
    {
        if($this->historico->count() > 0)
        {
            return $this->historico[0]->who->name;
        }
        else
        {
            return 'Error - Sin Supervisor?';
        }

    }






}
