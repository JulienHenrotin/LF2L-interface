<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tacheController extends Controller
{
    function new_tache()
    {
        $tache = new \App\taches;
        $tache -> nom_tache = request('nom');
        $tache -> description_tache = request('desc');
        $tache -> save();
    }
}
