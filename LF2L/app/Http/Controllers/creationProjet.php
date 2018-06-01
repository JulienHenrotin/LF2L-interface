<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class creationProjet extends Controller
{
    function affichage()
    {
        $financements = \App\parti_prenant::all();
        return view('projet\creationProjet', [
            'financements' => $financements,
        ]);
//        affichage de la page de creation de projet et envoi de la table partie prenant pour afficher
//    les différentes sources
    }

    function traitement()
    {
        //instanciation de la bdd puis ajout d'un enregistrement
        // dans la  table
//        $nom = $_POST['titre'];
//        $date_pu = $_POST['date_pu'];
//        $super = $_POST['super'];

        $nom = request('titre');
        $date_pu = request('date_pu');
        $argent = request('argentcache');


        $projet = new \App\projet;
        $projet->nom_projet = $nom;
        $projet->date_lancement_projet = $date_pu;
        $projet->save();

        $idcourant = \App\projet::where('nom_projet', $nom)->get();
        //dd($idcourant[0]->nom_projet);
        //traitement du string

        $pattern_resources = "#.*?;#";
        $pattern = "#(.*?),(.*?);#";
        $x = 0;

        //$final=array();
        preg_match_all($pattern_resources, $argent, $match_taches);
        //dd($match_taches);
        foreach ($match_taches as $match_tach) {
            foreach ($match_tach as $match2) {
                preg_match_all($pattern, $match2, $deuxieme);
                $final[$x][0] = $deuxieme[1][0];
                $final[$x][1] = $deuxieme[2][0];
                $x = $x + 1;
            }
        }
        //dd($final[]);
        $compteur = count($final);
        //dd($compteur);
        for ($h = 0; $h < $compteur; $h++) {    //METRE A 1
            $temporaire = $final[$h][0];
            $tempoargent = $final[$h][1];
            $idparti = \App\parti_prenant::where('nom_source', $temporaire)->get();
            //dd($idparti[0]->nom_source);
            echo $h . '<br>';
            echo "nom source".$temporaire.'<br>';
            dump($idparti);
            // echo $idparti[1]->id_source_financement;
            //echo $idparti[2]->id_source_financement;


//            if ($h == 2) {
//                echo "-".$temporaire = $final[2][0]."-";
//                dd($idparti);
//            }

            $finance = new \App\finance;
            $finance->montant_finance = $tempoargent;
            $finance->id_source_financement = $idparti[0]->id_source_financement;
            $finance->id_projet = $idcourant[0]->id_projet;
            $finance->save();


        }
        //requete pour trouver id de partie prenant corespondant
        //ajouter dans la table de relation
        //redirect('http://lf2l/detailProjet?nom='.$nom.'&date_pu='.$date_pu);
       return view('premiere');
    }
}
