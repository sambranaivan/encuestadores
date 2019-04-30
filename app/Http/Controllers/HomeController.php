<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->role) {
            case 0:
                return redirect()->route('homeEncuestadores');
                break;
             case 2:
                return redirect()->route('homeCoordinador');
                break;
             case 1:
                return redirect()->route('homeSupervisor');
                break;

            default:
                # code...
                break;
        }
    }
}
