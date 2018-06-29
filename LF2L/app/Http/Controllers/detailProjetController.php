<?php
namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");




use Illuminate\Http\Request;

class detailProjetController extends Controller
{
    function affichage()
    {
        $resources = \App\ressources::all();
        $tablesP = \App\personne::all();
        $tableTache = \App\taches::all();
        $processus =  \App\processus::all();

//        if (request('taches')!= null)
//        {
//            dump(request('taches'));
//            dump(request('personnes'));
//            dump(request('processus'));
//            dump (request('ressources'));
//        }

        return view("projet/detailProjet", [
            'resourcesBDD'=>$resources,
            'tablesP'=>$tablesP,
            'tableTache'=>$tableTache,
            'processus'=>$processus,
        ]);
    }

    function traitement()
    {
        dd('salut');
        $activite = new \App\activite;
        $activite->nom_activite =$_POST["nomACT"];
        $activite->description_activite="0";
        $activite->save();
        return view("premiere");
    }
}

