

<?php
header ('Content-type:text/html; charset=utf-8');
$url = "https://api.archives-ouvertes.fr/search/hal/?omitHeader=true&wt=bibtex&q=erpi&fq=NOT+instance_s%3Asfo&fq=NOT+instance_s%3Adumas&fq=NOT+instance_s%3Amemsic&fq=NOT+%28instance_s%3Ainria+AND+docType_s%3A%28MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Aafssa+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aenpc+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+SYNTHESE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Auniv-mlv+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Ademocrite+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aafrique+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Asaga+AND+docType_s%3A%28PRESCONF+OR+BOOKREPORT%29%29&fq=NOT+%28instance_s%3Aunice+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Alara+AND+docType_s%3AREPACT%29&fq=NOT+%28docType_s%3A%28THESE+OR+HDR%29+AND+submitType_s%3A%28notice+OR+annex%29%29&fq=NOT+%28instance_s%3Alaas+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aephe+AND+docType_s%3AMEM%29&fq=NOT+instance_s%3Ahceres&fq=NOT+status_i%3A111&fq=%7B%21tag%3Dtag0__docType_s%7DdocType_s%3A%28%22ART%22+OR+%22OUV%22+OR+%22COUV%22+OR+%22DOUV%22+OR+%22REPORT%22+OR+%22OTHER%22+OR+%22HDR%22+OR+%22LECTURE%22+OR+%22UNDEFINED%22+OR+%22POSTER%22+OR+%22COMM%22+OR+%22THESE%22%29&fq=%7B%21tag%3Dtag1__submitType_s%7DsubmitType_s%3A%28%22file%22%29&defType=edismax&rows=2000";
$pattern_hal = "#\{([tel|hal|halshs]*-[0-9]*)\}#";
$subject = htmlspecialchars(implode('', file($url)));
preg_match_all($pattern_hal, $subject, $matches_hal);
ini_set('max_execution_time', 0);
//print_r($matches_hal);

for ($i = 0; $i < count($matches_hal[1]); $i++) {
    $verif = 1;
    $tables = \App\publication::all();
    foreach ($tables as $table) {
        if ($table->identifiant == $matches_hal[1][$i]) {
            $verif = 0;
        }
    }
    if ($verif == 1) {
        //echo  "<script>console.log('$i')</script>";
        echo $matches_hal[1][$i] . "<br>";
        //echo $i."<br>";


        $url_brut = 'https://hal.archives-ouvertes.fr/' . $matches_hal[1][$i] . '/tei';
        $donnees = htmlspecialchars(implode('', file($url_brut)));
        $pattern_type = "#&quot;halTypology&quot; n=&quot;([A-Z]*)&quot;#";
        $pattern_titre = "#title xml:lang=&quot;[a-z]*&quot;.{0,20}&gt;([^/]*)#";
        $pattern_aut = "#&lt;forename type=&quot;first&quot;&gt;[^¤]*?/surname#";
        $pattern_prenom = "#type=&quot;first&quot;&gt;(.*?)&lt;#";
        $pattern_nom = "#surname&gt;(.*?)&lt;#";
        $pattern_langue = "#language ident=&quot;[a-z]{0,4}&quot;&gt;(.*?)&lt;#";





        preg_match_all($pattern_langue, $donnees, $matches_langue);
        preg_match_all($pattern_aut, $donnees, $matches_aut);
        preg_match_all($pattern_type, $donnees, $matches_type);
        preg_match_all($pattern_titre, $donnees, $matches_titre);




        echo "langue : " . $matches_langue[1][0] . "<br>";


        if (empty($matches_titre[1][1])) {
            echo "Titre manquant<br>";
        } else {
            echo "titre: " . substr($matches_titre[1][1], 0, -4) . "<br>";
        }

        echo "type : " . $matches_type[1][0] . "<br>";


        echo "auteur(s) : <br>";







        echo "<br>";

        $publi = new App\publication;
        $publi->titre_article = substr($matches_titre[1][1], 0, -4);
        $publi->domaine_article = 'nop';
        $publi->langue_article = $matches_langue[1][0];
        $publi->identifiant = $matches_hal[1][$i];


        if ($matches_type[1][0] == 'THESE' || $matches_type[1][0] == 'HDR') {
            $pattern_date = "#type=&quot;whenProduced&quot;&gt;(.*?)&lt;#";
            preg_match_all($pattern_date, $donnees, $matches_date);
            $publi->date_publication = $matches_date[1][0];
        }
        elseif($matches_type[1][0] == 'UNDEFINED' || $matches_type[1][0] == 'REPORT') {
            $pattern_date = "#type=&quot;whenWritten&quot;&gt;(.*?)&lt;#";
            preg_match_all($pattern_date, $donnees, $matches_date);
            $publi->date_publication = $matches_date[1][0];
        }
        elseif ($matches_type[1][0] == 'POSTER' || $matches_type[1][0] == 'COMM') {
            $pattern_date = "#type=&quot;start&quot;&gt;(.*?)&lt;#";
            preg_match_all($pattern_date, $donnees, $matches_date);
            $publi->date_publication = $matches_date[1][0];
        }
        else{
            $pattern_date = "#type=&quot;datePub&quot;&gt;(.*?)&lt;#";
            preg_match_all($pattern_date, $donnees, $matches_date);
            $publi->date_publication = $matches_date[1][0];
        }
        $publi->save();



    for ($auteur = 0; $auteur < count($matches_aut[0]) / 2; $auteur++) {

        preg_match_all($pattern_prenom, $matches_aut[0][$auteur], $matches_prenom);
        preg_match_all($pattern_nom, $matches_aut[0][$auteur], $matches_nom);
        echo $matches_prenom[1][0] . "  ";
        echo $matches_nom[1][0] . "<br>";
        $personnes = \App\personne::all();
        $test_personne = 0;
        $search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[ıîïÎÏ]@i','@[ûùüÛÜ]@i','@[ôööÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
        $replace = array ('e','a','i','u','o','c','_','');
        $nom = preg_replace($search,$replace,$matches_nom[1][0]);
        $prenom = preg_replace($search,$replace,$matches_prenom[1][0]);
        foreach ($personnes as $personne) {
            if ($nom == $personne -> Nom && $prenom == $personne -> prenom) {
                $test_personne = 1;
            }
        }
        if($test_personne == 0){


            $new_personne = new \App\personne;
            $new_personne -> Nom = $nom;
            $new_personne -> prenom = $prenom;
            $new_personne -> save();
            }

        $articles = \App\publication::where('identifiant', $matches_hal[1][$i])->get();
        $personnes =  App\personne::all();
        foreach ($articles as $article){
            foreach ($personnes as $personne) {
                if($nom == $personne -> Nom && $prenom == $personne -> prenom){
                    $redige = new App\redige_article();
                    $redige->id_article = $article->id_article;
                    $redige->id_personne = $personne ->id_personne;
                    $redige->save();
                }
            }
        }
    }




        if ($matches_type[1][0] == 'REPORT') {


            $articles = \App\publication::where('identifiant', $matches_hal[1][$i])->get();
            $rapport = new App\rapport();
            foreach ($articles as $article) {

                $rapport->id_article = $article->id_article;
                //dd($matches_type[1][0],$matches_hal[1][$i]);
                $rapport->save();

            }
        }


        if ($matches_type[1][0] == 'UNDEFINED') {

            $articles = \App\publication::where('identifiant', $matches_hal[1][$i])->get();
            $prepubli = new App\prepublication;
            foreach ($articles as $article) {

                $prepubli->id_article = $article->id_article;
                $prepubli->save();

            }
        }

        echo "<br>";
        if ($matches_type[1][0] == 'THESE' || $matches_type[1][0] == 'HDR') {

            if ($matches_type[1][0] == 'THESE') {
                $pattern_ecole = "#type=&quot;institution&quot;&gt;(.*?)&lt;#";
                $pattern_jure = "#type=&quot;jury&quot;&gt;(.*?)(&lt;|\[)#";
                preg_match_all($pattern_ecole, $donnees, $matches_ecole);
                preg_match_all($pattern_jure, $donnees, $matches_jure);


            }
            if ($matches_type[1][0] == 'HDR') {
                $pattern_ecole = "#type=&quot;institution&quot;&gt;(.*?)&lt;#";
                $pattern_jury = "#type=&quot;jury&quot;&gt;(.*?)&lt;#";
                $pattern_jure = "#[\.](.*?)\(#";
                preg_match_all($pattern_ecole, $donnees, $matches_ecole);
                preg_match_all($pattern_jury, $donnees, $matches_jury);
                preg_match_all($pattern_jure, $matches_jury[1][0], $matches_jure);

            }

            echo "jury : <br>";

            for ($jury = 0; $jury < count($matches_jure[0]); $jury++) {
                echo $matches_jure[1][$jury] . "<br>";
                $verif_jure = 1;
//                if ($matches_hal[1][$i] == 'tel-01816267'){
//                    dd($matches_jure);
//
//                }
                $jures= \App\jure::all();
                foreach ($jures as $jure){
                    if ($jure -> nom_jure == $matches_jure[1][$jury]){
                        $verif_jure = 0;
                    }
                }

                if($verif_jure==1){

                    $accents = array('À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ð','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ');
                    $sans = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y');

                    $nompre = str_replace($accents,$sans,$matches_jure[1][$jury]);

                    $new_jure = new App\jure;
                    $new_jure -> nom_jure = $nompre;
                    $new_jure -> prenom_jure = '';
                    $new_jure -> save();

                    $publications= \App\publication::all();
                    $liste_jures = \App\jure::all();
                    foreach ($publications as $publication){
                        if ($publication -> identifiant == $matches_hal[1][$i] ){
                            foreach ($liste_jures as $liste_jure){
                                if ($liste_jure -> nom_jure == $matches_jure[1][$jury]){
                                    $new_juge = new App\juge;
                                    $new_juge -> id_article = $publication -> id_article;
                                    $new_juge -> id_jury = $liste_jure -> id_jury;
                                    $new_juge -> save();
                                }
                            }
                        }
                    }
                }
            }
            echo "établissement : " . $matches_ecole[1][0] . "<br>";


            $verif_etablissement = 1;
            $etablissements= \App\etablissement::all();
            foreach ($etablissements as $etablissement){
                if ($etablissement -> nom_etablissement == $matches_ecole[1][0]){
                    $verif_etablissement = 0;
                }
            }

            if($verif_etablissement==1){
                $new_etablissement = new App\etablissement;
                $new_etablissement -> nom_etablissement = $matches_ecole[1][0];
                $new_etablissement -> save();
            }

            $articles = \App\publication::where('identifiant', $matches_hal[1][$i])->get();
            $lien_etablissements = \App\etablissement::where('nom_etablissement', $matches_ecole[1][0])->get();
            $new_these_ou_hdr = new App\theseouhdr;
            foreach ($articles as $article) {
                foreach ($lien_etablissements as $lien_etablissement) {
                    $new_these_ou_hdr->id_article = $article->id_article;
                    $new_these_ou_hdr->id_etablissement = $lien_etablissement->id_etablissement;
                    $new_these_ou_hdr->save();
                    //dd($matches_type[1][0],$matches_hal[1][$i]);
                }
            }
            if ($matches_type[1][0] == 'THESE'){
                $new_these = new App\these;

                foreach ($articles as $article) {
                    $new_these->id_article = $article->id_article;
                    $new_these->save();
                }

            }

            if ($matches_type[1][0] == 'HDR'){
                $new_hdr = new App\hdr;

                foreach ($articles as $article) {
                    $new_hdr->id_article = $article->id_article;
                    $new_hdr->save();
                }

            }




        }
        if ($matches_type[1][0] == 'ART') {
            $pattern_journal = "#type=&quot;halRef&quot;&gt;(.*?),(.*?),#";

            preg_match_all($pattern_journal, $donnees, $matches_journal);

            echo "journal : " . $matches_journal[1][0] . "<br>";
            echo "editeur : " . $matches_journal[2][0] . "<br>";


           $verif_editeur = 1;
            $editeurs= \App\editeur_journal::all();
            foreach ($editeurs as $editeur){
                if ($editeur -> nom_editeur_journal == $matches_journal[2][0]){
                    $verif_editeur = 0;
                }
            }

            if($verif_editeur==1){
                $new_editeur = new App\editeur_journal;
                $new_editeur -> nom_editeur_journal = $matches_journal[2][0];
                $new_editeur -> numero_editeur = 0;
                $new_editeur -> pays_edit_journal = "n/a";
                $new_editeur -> ville_edit_journal = "n/a";
                $new_editeur -> save();
            }

            $verif_journal = 1;
            $journaux= \App\journal::all();
            foreach ($journaux as $journal){
                if ($journal -> nom_journal == $matches_journal[1][0]){
                    $verif_journal = 0;
                }
            }
            $liste_editeurs= \App\editeur_journal::where('nom_editeur_journal',$matches_journal[2][0])->get();
            if($verif_journal==1){
                foreach ($liste_editeurs as $liste_editeur){
                $new_journal = new App\journal;
                $new_journal -> nom_journal = $matches_journal[1][0];
                $new_journal -> id_editeur_journal = $liste_editeur -> id_editeur_journal ;
                $new_journal -> id_impact_journal = 1;
                $new_journal -> save();
                }
            }
            $articles = \App\publication::where('identifiant', $matches_hal[1][$i])->get();

            $article_journal = new App\article_publication_presse;
            foreach ($articles as $article) {
                $article_journal->id_article = $article->id_article;
                $article_journal->save();}
             $liste_journaux = \App\journal::where('nom_journal', $matches_journal[1][0])->get();


            $lien_journal = new App\article_dans_journal;
            foreach ($articles as $article) {
                foreach ($liste_journaux as $journal) {
                    $lien_journal->id_article = $article->id_article;
                    $lien_journal->id_journal = $journal->id_journal;
                    $lien_journal->save();}
                    }



        }


        if ($matches_type[1][0] == 'POSTER' || $matches_type[1][0] == 'COMM') {

            $pattern_titre_conf = "#title&gt;(.*?)&lt;#";
            $pattern_pays = "#country key=&quot;[A-Z]{0,4}&quot;&gt;(.*?)&lt;#";
            $pattern_ville = "#settlement&gt;(.*?)&lt;#";
            $pattern_lieu = "#&lt;meeting&gt;[^¤]*?/meeting#";
            $pattern_debut_conf = "#date type=&quot;start&quot;&gt;(.*?)&lt;#";

            preg_match_all($pattern_lieu, $donnees, $matches_lieu);
            preg_match_all($pattern_titre_conf, $matches_lieu[0][0], $matches_titre_conf);
            preg_match_all($pattern_pays, $matches_lieu[0][0], $matches_pays);
            preg_match_all($pattern_ville, $matches_lieu[0][0], $matches_ville);
            preg_match_all($pattern_debut_conf, $matches_lieu[0][0], $matches_debut_conf);

            echo "titre de la conf : " . $matches_titre_conf[1][0] . "<br>";
            echo "pays : " . $matches_pays[1][0] . "<br>";
            echo "ville : " . $matches_ville[1][0] . "<br>";
            echo "début de la conf : " . $matches_debut_conf[1][0] . "<br>";


            $articles= \App\publication::where('identifiant',$matches_hal[1][$i])->get();

             $publi_conf = new App\publication_conference;
            foreach ($articles as $article){

                $publi_conf -> id_article = $article -> id_article;
                $publi_conf -> id_editeur_conference = 1;
                $publi_conf -> save();
            }
            $conference = new App\conference;

            if ($matches_type[1][0] == 'POSTER'){
                foreach ($articles as $article){
                $poster = new App\poster;
                $poster -> id_article = $article -> id_article;
                $poster -> save();
                }
            }
            if ($matches_type[1][0] == 'COMM'){
                foreach ($articles as $article){
                    $article_conference = new App\article_conference;
                    $article_conference -> id_article = $article -> id_article;
                    $article_conference -> save();
                }
            }
            $verif_conf =1;
            $liste_conferences= \App\conference::all();
            foreach ($liste_conferences as $liste_conference){
                if ($liste_conference -> numero_conference == $matches_titre_conf[1][0]){
                    $verif_conf = 0;
                }
            }

            if($verif_conf==1){
                $conference = new App\conference;
                $conference -> numero_conference = $matches_titre_conf[1][0];
                $conference -> pays_conference = $matches_pays[1][0];
                $conference -> ville_conference = $matches_ville[1][0];
                $conference -> date_conference = $matches_debut_conf[1][0];
                $conference -> save();
            }
            $liste_conf= \App\conference::where('numero_conference',$matches_titre_conf[1][0])->get();
            foreach ($liste_conf as $conf){
                foreach ($articles as $article){
                    $lien_conf = new App\utilise_pour_conference;
                    $lien_conf -> id_article = $article -> id_article;
                    $lien_conf -> id_conference  = $conf -> id_conference;
                    $lien_conf -> save();

                }
            }

        }

    }
}

?>

