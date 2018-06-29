<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class creationProjet extends Controller
{
    function affichage()
    {
        $personne = \App\personne::all();
        return view('projet\creationProjet', [
            'personne' => $personne
        ]);
//        affichage de la page de creation de projet et envoi de la table partie prenant pour afficher
//    les différentes sources
    }

    function traitement()
    {
        //instanciation de la bdd puis ajout d'un enregistrement
        // dans la  table

        $nom = request('titre');
        $date_pu = request('date_pu');
        $personne_et_role = request('argentcache');


        $projet = new \App\projet;
        $projet->nom_projet = $nom;
        $projet->date_lancement_projet = $date_pu;
        $projet->save();

        $idcourant = \App\projet::where('nom_projet', $nom)->get();
        dump($idcourant[0]->id_projet);
        $pattern_resources = "#.*?;#";
        $pattern = "#(.*?),(.*?);#";
        $pattern2 = "#(.*?) (.*)#";
        $x = 0;
        // personne_et_role --> string avec : persone,role;personne,role
        preg_match_all($pattern_resources, $personne_et_role, $match_taches);
        foreach ($match_taches as $match_tach) {
            foreach ($match_tach as $match2) {
                preg_match_all($pattern, $match2, $deuxieme);
                $final[$x][0] = $deuxieme[1][0];
                $final[$x][1] = $deuxieme[2][0];
                $x = $x + 1;
            }
        }
        dump($final);
        $compteur = count($final);
        dump($compteur);
        $personnes = \App\personne::all();
        for ($h = 0; $h < $compteur; $h++) {
            //la variable string de départ est déoupée et rangée dans des tableaux
            $temporaire = $final[$h][0];
            $temporole = $final[$h][1];

            preg_match_all($pattern2, $temporaire, $match_tempo);

            foreach ($personnes as $personne) {
                //requettes double condition
                // on cherches les personnes dans la BDD par rapport a nom et prénom
                if ($match_tempo[1][0] == $personne->prenom && $match_tempo[2][0] == $personne->Nom) {
                    dump($personnes);
                    $new_participant = new \App\personne_participe_projet;
                    $new_participant->id_personne = $personne->id_personne;
                    $new_participant->id_projet = $idcourant[0]->id_projet;
                    $new_participant ->role_personne_projet = $temporole;
                    $new_participant->save();
                }
            }
        }
        session::put('projet.nom', $nom);
        return redirect('/detailProjet');
    }
}
