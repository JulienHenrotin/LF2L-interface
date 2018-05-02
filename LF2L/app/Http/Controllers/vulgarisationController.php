<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vulgarisationController extends Controller
{
    function affichage()
    {
        return view('publication/vulgarisation');
    }
    function traitement()
    {
        echo "traitement fait";
    }
}
