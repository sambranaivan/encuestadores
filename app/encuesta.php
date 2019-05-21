<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class encuesta extends Model
{
        use SoftDeletes;
    //

    public function historico(){
        return $this->hasMany('App\historico_e');
    }

     public function condicion(){
        switch ($this->efectivo) {
            case 0:
                return "No Efectiva";
                break;
                case 1:
                return "Efectiva";
                break;
                case 2:
                return "Otro";
                break;

            default:
                # code...
                break;
        }
    }

    public function isHistorico(){
        if($this->area)
        {
            return $this->area->isHistorico();
        }
        return false;

    }

    public function estado(){
        if($this->efectivo == 1)
        {
            foreach ($this->componentes as $individual)
                {
                    if($individual->estado() == false)
                    {
                        return false;
                    }

                }

        return true;
        }
        else
        {
            return false;
        }

    }

    public function esPobre()
    {
        if($this->estado())
        {
            if($this->getMinimo() < $this->getMonts())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function diff()
    {
        return ceil($this->getMonts()- $this->getMinimo());
    }

    public function pordiff()
    {
        if($this->getMonts())
        {
            return  round(($this->diff() * 100)/$this->getMonts());

        }
    }

    public function status(){
        if($this->area->status == 'en supervision')
        {
            return $this->area->status."(".$this->area->supervisor->name.")";
        }
        else if($this->area->status == 'cargando')
        {
            return $this->area->status."(".$this->area->encuestador->name.")";
        }
        else
        {
            return $this->area->status;
        }
    }

    public function getMonts(){
        if($this->efectivo != 1)
        {
            return 0;
        }
        $m = 0;
        foreach ($this->componentes as $individual)
        {   $mont = $individual->getMonts();
            if( $mont == -9)
            {
            return -9;
            }
            $m += $individual->getMonts();
        }
        return $m;
    }



    public function getPonds()
    {
        $p = 0;
        foreach ($this->componentes as $individual)
        {
            $p += $individual->getPond();
        }
        return $p;
    }

    public function getMinimo(){
        return $this->getPonds() * $this->cbt();
    }

    public function getIndigente(){
        return $this->getPonds() * 3500;
    }

    public function componentes(){
        return $this->hasMany('App\individual');
    }

    public function area(){
        return $this->belongsTo('App\area');
    }

    public function encuestador(){
        return $this->belongsTo('App\user');
    }

    public function cbt(){
        return $this->area->cbt();
    }


    public function fueSuper(){
        foreach ($this->componentes as $individual)
        {
            if($individual->fueSuper())
            {
                return true;
            }
        }
        return false;
    }


    //

    public function cambios()
    {
        return $this->hasMany('App\historico_e');
    }

    public function hasCambios()
    {
        foreach ($this->componentes as $individual)
        {
            if($individual->hasCambios())
            {
                return true;
            }
        }
        return false;
    }

    public function ingreso_individual()
    {
        $individual = $this->getMonts() / $this->getPonds();
        return $individual;
    }

}
