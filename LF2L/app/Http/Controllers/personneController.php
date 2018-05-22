<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class personneController extends Controller
{
    function affiche_personne()
    {   $personnes = \App\personne::all();
        $enseignants_chercheur = \App\enseignant_chercheur::all();
        $externe = \App\externe::all();
        return view('personne/personne',['enseignants_chercheur' => $enseignants_chercheur, 'externe' => $externe, 'personnes' => $personnes]);

    }

    function new_personne()
    {
        echo $_POST["Organisation"]."<br>";
        echo $_POST["role"];

        $new_personne = new \App\personne;
        $new_personne -> Nom = $_POST["nom"];
        $new_personne -> prenom = $_POST["prenom"];
        $new_personne -> mail_personne = $_POST["mail"];
        $new_personne -> save();
        $personnes = \App\personne::all();

        if($_POST["role"] == 'permanent'){
            foreach ($personnes as $personne){
                if($_POST["nom"] == $personne -> Nom && $_POST["prenom"] == $personne -> prenom) {
                    $new_permanent = new \App\permanent_plateforme;
                    $new_permanent -> id_personne = $personne->id_personne;
                    $new_permanent -> save();

                    if($_POST["inge"]=='1'){
                        $new_inge = new \App\ingenieur;
                        $new_inge -> id_personne = $personne->id_personne;
                        $new_inge -> save();
                    }
                    if($_POST["tech"]=='1'){
                        $new_tech = new \App\technicien;
                        $new_tech -> id_personne = $personne->id_personne;
                        $new_tech -> save();
                    }
                }

            }
        }
        if($_POST["role"] == 'client') {
            foreach ($personnes as $personne) {
                if ($_POST["nom"] == $personne->Nom && $_POST["prenom"] == $personne->prenom) {
                    $new_client = new \App\client;
                    $new_client->id_personne = $personne->id_personne;
                    $new_client->save();


                }
            }
        }
        if($_POST["role"] == 'etudiant') {
            $etablissements_etudiant_existe = 0;
            $etablissements_etudiant = \App\etablissement_etudiant::all();
            foreach ($etablissements_etudiant as $etablissement_etudiant) {
                if ($_POST["Etablissement"] == $etablissement_etudiant->nom_etablissement_etudiant) {
                    $etablissements_etudiant_existe = 1;
                }
            }
            if ($etablissements_etudiant_existe == 0) {
                $new_etablissement_etudiant = new \App\etablissement_etudiant;
                $new_etablissement_etudiant->nom_etablissement_etudiant = $_POST["Etablissement"];
                $new_etablissement_etudiant->save();
            }

            $niveaux = \App\niveau_etudiant::all();
            $etablissements_etudiant = \App\etablissement_etudiant::all();

            foreach ($personnes as $personne) {
                if ($_POST["nom"] == $personne->Nom && $_POST["prenom"] == $personne->prenom) {
                    $new_etudiant = new \App\etudiants;
                    $new_etudiant->id_personne = $personne->id_personne;

                    foreach ($niveaux as $niveau) {
                        if ($niveau->niveau == $_POST["Niveau"]) {
                            $new_etudiant->id_niveau = $niveau->id_niveau;
                        }
                    }
                    foreach ($etablissements_etudiant as $etablissement_etudiant) {
                        if ($_POST["Etablissement"] == $etablissement_etudiant->nom_etablissement_etudiant) {
                            $new_etudiant->id_etablissement_etudiant = $etablissement_etudiant->id_etablissement_etudiant;
                        }
                    }
                    $new_etudiant->save();
                }
            }
        }
            if($_POST["role"] == 'externe') {
                echo "test";
                $organisation_existe = 0;
                $organisations = \App\organisation::all();
                foreach ($organisations as $organisation) {
                    if ($_POST["Organisation"] == $organisation->nom_organisation) {
                        $organisation_existe = 1;
                    }
                }
                if ($organisation_existe == 0) {
                    $new_organisation = new \App\organisation;
                    $new_organisation-> nom_organisation = $_POST["Organisation"];
                    $new_organisation->save();
                }

//                $niveaux = \App\niveau_etudiant::all();
//                $etablissements_etudiant = \App\etablissement_etudiant::all();
//
//                foreach ($personnes as $personne) {
//                    if ($_POST["nom"] == $personne->Nom && $_POST["prenom"] == $personne->prenom) {
//                        $new_etudiant = new \App\etudiants;
//                        $new_etudiant->id_personne = $personne->id_personne;
//
//                        foreach ($niveaux as $niveau) {
//                            if ($niveau->niveau == $_POST["Niveau"]) {
//                                $new_etudiant->id_niveau = $niveau->id_niveau;
//                            }
//                        }
//                    }
//                }

    }
}
}
