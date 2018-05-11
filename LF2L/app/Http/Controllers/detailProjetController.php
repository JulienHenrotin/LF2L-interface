<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class detailProjetController extends Controller
{
    function affichage()
    {
        return view("projet/detailProjet");
    }
}
