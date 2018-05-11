<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class detailProjetController extends Controller
{
    function affichage()
    {
        $resources = \App\resources::all();

        return view("projet/detailProjet", [
            'resources'=>$resources,
        ]);
    }
}
