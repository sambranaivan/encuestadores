<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class encuesta extends Model
{
        use SoftDeletes;
    //

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
        return $this->getPonds() * 7405;
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

    public function esPobre(){
        if($this->getMinimo() < $this->getMonts())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
