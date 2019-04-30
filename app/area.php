<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    //
    public function encuestas(){
        return $this->hasMany('App\encuesta');
    }

    public function getEfectiva(){
        $a = $this->encuestas;
        $c = 0;
        foreach ($a as $item) {
            if($item->efectivo)
            {
                $c++;
            }
        }
        return $c;
    }
    public function getNoEfectiva(){
        $a = $this->encuestas;
        $c = 0;
        foreach ($a as $item) {
            if(!$item->efectivo)
            {
                $c++;
            }
        }
        return $c;
    }
}
