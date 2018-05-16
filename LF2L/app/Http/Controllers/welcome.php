<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;


class welcome extends Controller
{
    function affichage()
    {
        return view('premiere');
    }

    function reponse()
    {
        if(Input::get('Listedenosprojet'))
        {
            return redirect('nosProjet');
        }
        if(Input::get('Listedesproduits'))
        {
            return redirect('listeProduits');
        }
        if(Input::get('Mesprojets'))
        {
            return redirect('mesProjets');
        }
        if(Input::get('Creerunprojet'))
        {
            return redirect('creationProjet');
        }
    }
}
