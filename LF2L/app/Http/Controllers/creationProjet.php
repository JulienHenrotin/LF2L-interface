<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creationProjet extends Controller
{
    function affichage()
    {
        $financements = \App\parti_prenant::all();
        return view ('projet\creationProjet' , [
            'financements' => $financements,
        ]);
//        affichage de la page de creation de projet et envoi de la table partie prenant pour afficher
//    les différentes sources
    }
    function traitement()
    {
        //instanciation de la bdd puis ajout d'un enregistrement
       // dans la  table

//        $projet=new \App\projet;
//        $projet ->nom_projet = request('titre');
//        $projet->date_lancement_projet = request('date');
//        $projet->save();

      //  $argent=$_POST['argent'];
        //faire traitement du string
        //requete pour trouver id de partie prenant corespondant
        //ajouter dans la table de relation
        //return view('projet\detailProjet');
    }
}
