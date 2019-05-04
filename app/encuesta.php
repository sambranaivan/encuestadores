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

    public function componentes(){
        return $this->hasMany('App\individual');
    }
}
