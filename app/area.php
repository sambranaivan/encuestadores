<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    //
    public function encuestas(){
        return $this->hasMany('App\encuesta');
    }
}
