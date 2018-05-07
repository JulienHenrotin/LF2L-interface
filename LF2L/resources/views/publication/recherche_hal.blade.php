
<?php
$url = 'https://api.archives-ouvertes.fr/search/hal/?omitHeader=true&wt=bibtex&q=erpi&fq=NOT+instance_s%3Asfo&fq=NOT+instance_s%3Adumas&fq=NOT+instance_s%3Amemsic&fq=NOT+%28instance_s%3Ainria+AND+docType_s%3A%28MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Aafssa+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aenpc+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+SYNTHESE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Auniv-mlv+AND+docType_s%3A%28OTHERREPORT+OR+MINUTES+OR+NOTE+OR+MEM+OR+PRESCONF%29%29&fq=NOT+%28instance_s%3Ademocrite+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aafrique+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Asaga+AND+docType_s%3A%28PRESCONF+OR+BOOKREPORT%29%29&fq=NOT+%28instance_s%3Aunice+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Alara+AND+docType_s%3AREPACT%29&fq=NOT+%28docType_s%3A%28THESE+OR+HDR%29+AND+submitType_s%3A%28notice+OR+annex%29%29&fq=NOT+%28instance_s%3Alaas+AND+docType_s%3AMEM%29&fq=NOT+%28instance_s%3Aephe+AND+docType_s%3AMEM%29&fq=NOT+instance_s%3Ahceres&fq=NOT+status_i%3A111&fq=%7B%21tag%3Dtag0__docType_s%7DdocType_s%3A%28%22ART%22+OR+%22COMM%22+OR+%22OUV%22+OR+%22COUV%22+OR+%22DOUV%22+OR+%22REPORT%22+OR+%22OTHER%22+OR+%22THESE%22+OR+%22HDR%22+OR+%22LECTURE%22+OR+%22UNDEFINED%22+OR+%22POSTER%22%29&fq=%7B%21tag%3Dtag1__submitType_s%7DsubmitType_s%3A%28%22file%22%29&defType=edismax&rows=2000';
$pattern_hal ="#\{([tel|hal|halshs]*-[0-9]*)\}#";
$subject = htmlspecialchars(implode('', file($url)));
preg_match_all($pattern_hal, $subject, $matches_hal);
ini_set('max_execution_time', 0);
//print_r($matches_hal);

/*for ($i = 0 ;$i < 113 ;$i++){
  echo  "<script>console.log('$i')</script>";
  echo $matches_hal[1][$i]."<br>";*/
    //echo $i;


$url_brut = 'https://hal.archives-ouvertes.fr/'.$matches_hal[1][100].'/tei';
$donnees = htmlspecialchars(implode('', file($url_brut)));
//echo $donnee;
$pattern_type ="#&quot;halTypology&quot; n=&quot;([A-Z]*)&quot;#";
$pattern_titre= "#title xml:lang=&quot;[a-z]*&quot;.{0,20}&gt;([^/]*)#";
$pattern_aut="#&lt;forename type=&quot;first&quot;&gt;[^¤]*?/surname#";
$pattern_prenom="#type=&quot;first&quot;&gt;(.*?)&lt;#";
$pattern_nom="#surname&gt;(.*?)&lt;#";
$pattern_langue="#language ident=&quot;[a-z]{0,4}&quot;&gt;(.*?)&lt;#";
$pattern_date="#type=&quot;whenSubmitted&quot;&gt;(.*?) #";



preg_match_all($pattern_date,$donnees,$matches_date);
preg_match_all($pattern_langue,$donnees,$matches_langue);
preg_match_all($pattern_aut,$donnees,$matches_aut);
preg_match_all($pattern_type, $donnees, $matches_type);
preg_match_all($pattern_titre,$donnees,$matches_titre);

echo "Date de publication : ".$matches_date[1][0]."<br>";


echo "langue : ".$matches_langue[1][0]."<br>";


    if(empty($matches_titre[1][1])) {
        echo "Titre manquant<br>";
    }
    else{
        echo "titre: ".substr($matches_titre[1][1],0,-4)."<br>";
    }

    echo "type : ".$matches_type[1][0]."<br>";

    if ($matches_type[1][0] == 'THESE'){
        $pattern_ecole="#type=&quot;institution&quot;&gt;(.*?)&lt;#";
        $pattern_jury="#type=&quot;jury&quot;&gt;(.*?)(&lt;|\[)#";
        preg_match_all($pattern_ecole,$donnees,$matches_ecole);
        preg_match_all($pattern_jury,$donnees,$matches_jury);
        echo "jury : <br>";

        for($jury=0;$jury < count($matches_jury[0]);$jury++){
            echo $matches_jury[1][$jury]."<br>";
        }
        echo "établissement : ".$matches_ecole[1][0]."<br>";

    }
        if ($matches_type[1][0] == 'HDR'){
            $pattern_ecole="#type=&quot;institution&quot;&gt;(.*?)&lt;#";
            $pattern_jury="#type=&quot;jury&quot;&gt;(.*?)&lt;#";
            $pattern_jure="#[\.](.*?)\(#";
            preg_match_all($pattern_ecole,$donnees,$matches_ecole);
            preg_match_all($pattern_jury,$donnees,$matches_jury);
            preg_match_all($pattern_jure,$matches_jury[1][0],$matches_jure);
            echo "jury : <br>";

            for($jury=0;$jury < count($matches_jure[0]);$jury++){
                echo $matches_jure[1][$jury]."<br>";
            }
            echo "établissement : ".$matches_ecole[1][0]."<br>";
            }


    if ($matches_type[1][0] == 'POSTER' || $matches_type[1][0] == 'COMM' ){

        $pattern_titre_conf="#title&gt;(.*?)&lt;#";
        $pattern_pays="#country key=&quot;[A-Z]{0,4}&quot;&gt;(.*?)&lt;#";
        $pattern_ville="#settlement&gt;(.*?)&lt;#";
        $pattern_lieu="#&lt;meeting&gt;[^¤]*?/meeting#";
        $pattern_debut_conf="#date type=&quot;start&quot;&gt;(.*?)&lt;#";
        $pattern_fin_conf="#date type=&quot;end&quot;&gt;(.*?)&lt;#";

        preg_match_all($pattern_lieu,$donnees,$matches_lieu);
        preg_match_all($pattern_titre_conf,$matches_lieu[0][0],$matches_titre_conf);
        preg_match_all($pattern_pays,$matches_lieu[0][0],$matches_pays);
        preg_match_all($pattern_ville,$matches_lieu[0][0],$matches_ville);
        preg_match_all($pattern_debut_conf,$matches_lieu[0][0],$matches_debut_conf);
        preg_match_all($pattern_fin_conf,$matches_lieu[0][0],$matches_fin_conf);

        echo "titre de la conf : ".$matches_titre_conf[1][0]."<br>";
        echo "pays : ".$matches_pays[1][0]."<br>";
        echo "ville : ".$matches_ville[1][0]."<br>";
        echo "début de la conf : ".$matches_debut_conf[1][0]."<br>";
        echo "fin de la conf : ".$matches_fin_conf[1][0]."<br>";

        echo "<br>";

    }


    echo "auteur(s) : <br>";

for($auteur=0;$auteur < count($matches_aut[0])/2;$auteur++){

    preg_match_all($pattern_prenom,$matches_aut[0][$auteur],$matches_prenom);
    preg_match_all($pattern_nom,$matches_aut[0][$auteur],$matches_nom);
    echo $matches_prenom[1][0]."  ";
    echo $matches_nom[1][0]."<br>";


}

echo "<br>";

//}

?>

