<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    //
    public function encuestas()
    {
        return $this->hasMany('App\encuesta');
    }

    public function getEfectiva()
    {
        $c = 0;

        $e = $this->encuestas;
        foreach ($e as $key => $value) {

            if($value->efectivo)
            {
                $c++;
            }
        }

        return $c;
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

            if(!$value->efectivo)
            {
                $c++;
            }
        }

        return $c;
    }
}
