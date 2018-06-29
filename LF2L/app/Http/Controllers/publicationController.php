<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class publicationController extends Controller
{
    function affiche()
    {
        $prepublications = \App\prepublication::all();
        $publications = \App\publication::all();
        $rapports = \App\rapport::all();
        $articles_publication_presse = \App\article_publication_presse::all();
        $liste_hdr = \App\hdr::all();
        $theses = \App\these::all();
        $publications_conference = \App\publication_conference::all();
        $etablissements = \App\etablissement::all();

        $personnes = \App\personne::all();
        $i = 0;
        $pattern_date = "#[0-9]{4}#";
            foreach ($publications as $publication){

            preg_match_all($pattern_date, $publication -> date_publication, $matches_date);
            $dates[$i] = $matches_date[0][0];
            $dates = array_unique($dates);
            $i++;

        }

        arsort($dates);

        return view('publication/publication2',['publications' => $publications, 'prepublications' => $prepublications,
            'rapports' => $rapports, 'articles_publication_presse' => $articles_publication_presse,
            'liste_hdr' => $liste_hdr, 'theses' => $theses, 'publications_conference' => $publications_conference,
            'etablissements' => $etablissements,"dates"=> $dates,'personnes'=>$personnes]);

    }
}
