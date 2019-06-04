<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historico extends Model
{
    //
    public function esSuper(){
        if($this->super !== null)
        {
           return true;
        }
        else
        {
            return false;
        }
    }

    public function who(){
        return $this->belongsTo('App\User','user_id');
    }
}
