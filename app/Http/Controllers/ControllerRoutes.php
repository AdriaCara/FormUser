<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerRoutes extends Controller
{
    
    public function form() {
        return view('form');
    }

    public function carregarFitxer() {

        return 'storage/uploads/$nomFitxer';


    }

}
