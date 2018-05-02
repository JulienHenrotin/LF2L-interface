<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creationProjet extends Controller
{
    function affichage()
    {
        return view ('projet\creationProjet');
    }
}
