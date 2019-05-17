<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historico extends Model
{
    //
    public function esSuper(){
        if($this->comentario == "")
        {
           return true;
        }
        else
        {
            return false;
        }
    }
}
