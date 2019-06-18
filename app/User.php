<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function areas(){
        return $this->hasMany('App\area');
    }



    public function isEncuestador(){
        return ($this->role == 0);
    }


    public function getIndividuales()
    {
        ///obtengo todas las encuestas
        $c = 0;
        foreach ($this->areas as $area)
        {
            foreach($area->encuestas as $encuesta)
            {
                $c += $encuesta->componentes->count();
            }
        }
        return $c;


        //devuelvo collecion

    }

     public function getIndividualesT($a,$t)
    {
        ///obtengo todas las encuestas
        $c = 0;
        foreach ($this->areas as $area)
        {
              if($area->anio == $a && $area->trimestre == $t)
              {

                  foreach($area->encuestas as $encuesta)
                  {
                      $c += $encuesta->componentes->count();
                    }
                }
        }

        // handshake para salve la division por 0
        if($c)
        {
            return $c;
        }
        else
        {
            return 1;
        }

    }

    public function getCorrecciones()
    {
        ///obtengo todas las encuestas
        $c = 0;
        foreach ($this->areas as $area)
        {
            foreach($area->encuestas as $encuesta)
            {
                foreach ($encuesta->componentes as $individual)
                {
                    ///de cada encuensta obtengo los historicos de cambios
                    $c += sizeof($individual->cambiosNoSuper());
                }
            }
        }
        return $c;
        //devuelvo collecion

    }

      public function getCorreccionesT($a,$t)
    {
        ///obtengo todas las encuestas
        $c = 0;
        foreach ($this->areas as $area)
        {
            if($area->anio == $a && $area->trimestre == $t)
            {
                foreach($area->encuestas as $encuesta)
                    {
                        foreach ($encuesta->componentes as $individual)
                        {
                            ///de cada encuensta obtengo los historicos de cambios
                            $c += sizeof($individual->cambiosNoSuper());
                        }
                    }
            }
        }
        return $c;
        //devuelvo collecion

    }




}
