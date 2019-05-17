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


    public function fueSuper(){
        if(is_null($this->super))
        {
            return false;
        }
        else
        {
            return true;
        }
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

}
