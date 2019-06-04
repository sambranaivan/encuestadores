<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\historico;
class IndividualController extends Controller
{
    //

    public function hyper($id){
        $historico = historico::find($id);

        $historico->super = 'super-super';

        $historico->save();

        return back();
    }
}
