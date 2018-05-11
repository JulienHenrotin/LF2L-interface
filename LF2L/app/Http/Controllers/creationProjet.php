<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creationProjet extends Controller
{
    function affichage()
    {
        return view ('projet\creationProjet');
    }
    function traitement()
    {
        $projet=new \App\projet;
        $projet ->nom_projet = request('titre');
        $projet->date_lancement_projet = request('date');
        $projet->save();
        return view('projet\detailProjet');
    }
}
