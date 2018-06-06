<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class personneController extends Controller
{
    function affiche_personne()
    {   $personnes = \App\personne::all();
        $enseignants_chercheur = \App\enseignant_chercheur::all();
        $externes = \App\externe::all();
        return view('personne/personne',['enseignants_chercheur' => $enseignants_chercheur, 'externes' => $externes, 'personnes' => $personnes]);

    }

    function new_personne()
    {


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
            $organisations = \App\organisation::all();
            foreach ($personnes as $personne) {
                if ($_POST["nom"] == $personne->Nom && $_POST["prenom"] == $personne->prenom) {
                    $new_externe = new \App\externe;
                    $new_externe->id_personne = $personne->id_personne;
                    $new_externe-> statut_externe = $_POST["Statut"];

                    foreach ($organisations as $organisation) {
                        if ($organisation -> nom_organisation == $_POST["Organisation"]) {
                            $new_externe -> id_organisation = $organisation -> id_organisation;
                        }
                    }
                    $new_externe->save();
                }
            }

        }
        if($_POST["role"] == 'enseignant_chercheur'){
            foreach ($personnes as $personne){
                if($_POST["nom"] == $personne -> Nom && $_POST["prenom"] == $personne -> prenom) {
                    $new_enseignant_chercheur = new \App\enseignant_chercheur;
                    $new_enseignant_chercheur -> id_personne = $personne->id_personne;
                    $new_enseignant_chercheur -> save();

                    if($_POST["chbx_EC_labo_interne"]=='1'){
                        $new_ec_interne = new \App\ec_interne;
                        $new_ec_interne -> id_personne = $personne->id_personne;
                        $new_ec_interne -> save();
                    }
                    if($_POST["chbx_EC_labo_externe"]=='1'){
                        $labo_existe = 0;
                        $laboratoires = \App\labo::all();
                        foreach ($laboratoires as $laboratoire) {
                            if ($_POST["labo_ec"] == $laboratoire->nom_labo) {
                                $labo_existe = 1;
                            }
                        }
                        if ($labo_existe == 0) {
                            $new_labo = new \App\labo;
                            $new_labo-> nom_labo = $_POST["labo_ec"];
                            $new_labo->save();
                        }
                        $laboratoires = \App\labo::all();
                        $new_ec_externe = new \App\ec_externe;
                        $new_ec_externe -> id_personne = $personne->id_personne;
                        foreach ($laboratoires as $laboratoire) {
                            if ($laboratoire -> nom_labo == $_POST["labo_ec"]) {
                                $new_labo_externe = new \App\labo_externe;
                                $new_labo_externe-> id_labo = $laboratoire -> id_labo;
                                $new_labo_externe->save();
                                $new_ec_externe -> id_labo = $laboratoire -> id_labo;
                            }
                        }
                        $new_ec_externe -> save();
                    }
                }
            }
        }
        if($_POST["role"] == 'doctorant') {
            $ecole_doctorante_existe = 0;
            $ecoles_doctorantes = \App\ecole_doctorante::all();
            foreach ($ecoles_doctorantes as $ecole_doctorante) {
                if ($_POST["Etablissement_doc"] == $ecole_doctorante->nom_ecole_doctorante) {
                    $ecole_doctorante_existe = 1;
                }
            }
            if ($ecole_doctorante_existe == 0) {
                $new_ecole_doctorante = new \App\ecole_doctorante;
                $new_ecole_doctorante->nom_ecole_doctorante = $_POST["Etablissement_doc"];
                $new_ecole_doctorante->save();
            }

            $labo_existe = 0;
            $laboratoires = \App\labo::all();
            foreach ($laboratoires as $laboratoire) {
                if ($_POST["labo_doc"] == $laboratoire->nom_labo) {
                    $labo_existe = 1;
                }
            }
            if ($labo_existe == 0) {
                $new_labo = new \App\labo;
                $new_labo->nom_labo = $_POST["labo_doc"];
                $new_labo->save();

                if ($_POST["chbx_labo_externe"] == '1') {
                    $laboratoires = \App\labo::all();
                    foreach ($laboratoires as $laboratoire) {
                        if ($_POST["labo_doc"] == $laboratoire->nom_labo) {
                            $new_labo_externe = new \App\labo_externe;
                            $new_labo_externe->id_labo = $laboratoire->id_labo;
                            $new_labo_externe->save();
                        }
                    }
                }
                if ($_POST["chbx_labo_interne"] == '1') {
                    $laboratoires = \App\labo::all();
                    foreach ($laboratoires as $laboratoire) {
                        if ($_POST["labo_doc"] == $laboratoire->nom_labo) {
                            $new_labo_interne = new \App\labo_interne;
                            $new_labo_interne->id_labo = $laboratoire->id_labo;
                            $new_labo_interne->save();
                        }
                    }
                }
            }
            foreach ($personnes as $personne) {
                if ($_POST["nom"] == $personne->Nom && $_POST["prenom"] == $personne->prenom) {
                    if ($_POST["chbx_MESNR"] == '1') {
                        $new_mesnr = new \App\mesnr;
                        $new_mesnr->id_personne = $personne->id_personne;
                        $new_mesnr->save();
                    }
                    if ($_POST["chbx_CIFRE"] == '1') {
                        $entreprise_existe = 0;
                        $entreprises = \App\entreprises::all();
                        foreach ($entreprises as $entreprise) {
                            if ($_POST["entreprise"] == $entreprise->nom_entreprise) {
                                $entreprise_existe = 1;
                            }
                        }
                        if ($entreprise_existe == 0) {
                            $new_entreprise = new \App\entreprises;
                            $new_entreprise->nom_entreprise = $_POST["entreprise"];
                            $new_entreprise->save();
                        }

                        $new_cifre = new \App\cifre;
                        $new_cifre->id_personne = $personne->id_personne;
                        $new_cifre->save();
                        foreach ($entreprises as $entreprise) {
                            if ($_POST["entreprise"] == $entreprise->nom_entreprise) {
                                $new_doctorant_entreprise = new \App\doctorant_entreprise;
                                $new_doctorant_entreprise->id_personne = $personne->id_personne;
                                $new_doctorant_entreprise->id_entreprise = $entreprise->id_entreprise;
                                $new_doctorant_entreprise->save();
                            }
                        }
                    }
                    foreach ($personnes as $encadrant) {
                        if ($_POST["responsable"] == $encadrant->prenom . " " . $encadrant->Nom) {
                            $ec_encadrant = \App\enseignant_chercheur::all();
                            $externes_encadrant = \App\externe::all();

                            foreach ($ec_encadrant as $doctorant_encadre) {
                                if ($doctorant_encadre->id_personne == $encadrant->id_personne) {
                                    $new_doctorant_encadre = new \App\doctorant_encadre;
                                    $new_doctorant_encadre->id_personne = $personne->id_personne;
                                    $new_doctorant_encadre->id_personne_Personne = $encadrant->id_personne;
                                    $new_doctorant_encadre->encadrant_EC_principal = "1";
                                    $new_doctorant_encadre->save();
                                }
                            }

                            foreach ($externes_encadrant as $externe_encadrant) {
                                echo $externe_encadrant->id_personne . ' ' . $encadrant->id_personne . "<br>";
                                if ($externe_encadrant->id_personne == $encadrant->id_personne) {
                                    $new_externe_encadre_doctorant = new \App\externe_encadre_doctorant();
                                    $new_externe_encadre_doctorant->id_personne = $personne->id_personne;
                                    $new_externe_encadre_doctorant->id_personne_Personne = $encadrant->id_personne;
                                    $new_externe_encadre_doctorant->encadrant_externe_principal = "0";
                                    $new_externe_encadre_doctorant->save();
                                }
                            }
                        }
                    }
                }
            }
            foreach ($personnes as $personne) {
                if ($_POST["nom"] == $personne -> Nom && $_POST["prenom"] == $personne -> prenom) {
                    $liste_labo = \App\labo::all();
                    $liste_ecoles = \App\ecole_doctorante::all();
                    $new_doctorant_encadre = new \App\doctorant;
                    $new_doctorant_encadre->id_personne = $personne->id_personne;
                    $new_doctorant_encadre->debut_contrat = $_POST["debut_contrat"];
                    $new_doctorant_encadre->fin_contrat = $_POST["fin_contrat"];
                    foreach ($liste_labo as $labo) {
                        if ($_POST["labo_doc"] == $labo->nom_labo ) {
                            $new_doctorant_encadre->id_labo = $labo->id_labo;

                        }
                    }
                    foreach ($liste_ecoles as $ecole) {
                        if ($_POST["Etablissement_doc"] == $ecole->nom_ecole_doctorante ) {
                            $new_doctorant_encadre->id_ecole_doctorante = $ecole->id_ecole_doctorante;

                        }
                    }
                    $new_doctorant_encadre->save();
                }
            }
        }
    }
}
