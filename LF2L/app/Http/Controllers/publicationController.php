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

        return view('publication/publication',['publications' => $publications, 'prepublications' => $prepublications,
            'rapports' => $rapports, 'articles_publication_presse' => $articles_publication_presse,
            'liste_hdr' => $liste_hdr, 'theses' => $theses, 'publications_conference' => $publications_conference,
            'etablissements' => $etablissements]);

    }
}
