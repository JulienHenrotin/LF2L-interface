<?php

namespace App\Http\Controllers;

use App\fournisseur;
use Illuminate\Http\Request;

class ressourceController extends Controller
{
    function reduction(){
        /////décrementation du de la ressource ($_POST["type"]) par la quantité selectionné ($_POST["nb"]) //////
    $ressources = \App\ressources::all();
        foreach ($ressources as $ressource) {
            if ($_POST["type"] == $ressource->type) {
                $ressource->increment('stock', -$_POST["nb"]);
                return redirect('/ressource_liste');
            }
        }
    }

    function  ajout(){
        /////ouvre le formulaire d'ajout d'une facture pour une ressource ($_POST["type"])/////
        return view('ressource/ressource_ajout',['type' => $_POST["type"]]);
    }

    function  facture(){
        /////retourne l'intégralité des factures relative à une ressource ($_POST["type"])/////
        $ressources = \App\ressources::all();
        $facture = \App\facture_ressource::all();
        $fournisseurs = \App\fournisseur::all();
        $factures_contient = $factures = \App\facture_contient::all();

        return view('ressource/facture',['factures_contient' => $factures_contient,'factures' => $facture,'fournisseurs' => $fournisseurs,'ressources' => $ressources, 'type' => $_POST["type"]]);
    }
    function liste(){
        ////ouvre la page de présentation des ressources/////
        $ressources = \App\ressources::all();

        return view('ressource/ressource_liste',['ressources' => $ressources]);
    }
    function new_photo(){
        request('image')->store('img','public');
    }

    function new_ressource(){
        /////verification de la validité de chant/////
        foreach($_POST as $cle=>$val) {
            if (empty($val)) {
                echo "<script>history.go(-1)</script>";
            }

        }



        /////ajoute une nouvelle ressource dans la BDD/////
        $ressource_existe = 0;
        $ressources = \App\ressources::all();
        foreach ($ressources as $ressource) {
            /////si la ressource existe déja on augmente juste le stock /////
            if ($_POST["nom"] == $ressource -> type) {
                $ressource_existe = 1;
                $ressource-> increment('stock',$_POST["quantite"]);
            }
        }
        if ($ressource_existe == 0) {
            /////sinon on ajoute la ressource dans la BDD/////
            $path = request('image')->store('img','public');
            $new_ressources = new \App\ressources;
            $new_ressources->type = $_POST["nom"];
            $new_ressources->img_ressources = $path;
            $new_ressources->date_acquisition = $_POST["date"];
            $new_ressources->stock = $_POST["quantite"];
            $new_ressources->model = $_POST["model"];
            $new_ressources->save();
            request('image')->store('img','public');


            /////férification du type de la ressource/////
            $ressources = \App\ressources::all();
            echo $_POST["type"];
            if($_POST["type"] == 'outil_numerique'){
                $type = new \App\outils_numeriques;
            }
            elseif($_POST["type"] == 'logiciel'){
                $type = new \App\logiciel;
            }
            elseif($_POST["type"] == 'materiel_bureau'){
                $type = new \App\materiel_bureau;
            }
            elseif($_POST["type"] == 'materiaux_consommable'){
                $type = new \App\materiaux_consomable;
            }
            elseif($_POST["type"] == 'piece_maintenance'){
                $type = new \App\pieces_maintenances;
            }
            elseif($_POST["type"] == 'machine'){
                $type = new \App\machine_creation;
                $type->nb_utilisations = 0;
            }


            foreach ($ressources as $ressource) {
                if ($_POST["nom"] == $ressource->type) {
                    $type->id_ressources = $ressource->id_ressources;
                    $type->save();
                }
            }
        }
        /////on vérifie si le fournisseur de la ressource existe deja/////
        $fournisseur_existe = 0;
        $fournisseurs = \App\fournisseur::all();
        foreach ($fournisseurs as $fournisseur) {
            if ($_POST["fournisseur"] == $fournisseur -> nom_fournisseur) {
                $fournisseur_existe = 1;
            }
        }
        /////si il n'existe pas on le créer////
        if ($fournisseur_existe == 0) {
            $new_fournisseur = new \App\fournisseur;
            $new_fournisseur->nom_fournisseur = $_POST["fournisseur"];
            $new_fournisseur->save();
        }

        $ressources = \App\ressources::all();
        $fournisseurs = \App\fournisseur::all();

        $new_facture = new \App\facture_ressource;
        $new_facture->quantite_ressources_facture = $_POST["quantite"];
        $new_facture->numero_facture = $_POST["num_facture"];

        foreach ($fournisseurs as $fournisseur) {
            if ($_POST["fournisseur"] == $fournisseur -> nom_fournisseur) {
                $new_facture->id_fournisseur= $fournisseur-> id_fournisseur;
            }
        }
        $new_facture->prix_ressource_HT = $_POST["prix"];
        $new_facture->save();
        ////ajout de la facture /////
        $factures = \App\facture_ressource::all();
        foreach ($factures as $facture) {
            if ($_POST["num_facture"] == $facture->numero_facture) {
                foreach ($ressources as $ressource) {
                    if ($_POST["nom"] == $ressource->type) {
                        $new_facture_contient = new \App\facture_contient;
                        $new_facture_contient-> id_facture = $facture->id_facture;
                        $new_facture_contient-> id_ressources = $ressource->id_ressources;
                        $new_facture_contient->save();
                    }
                }
            }
        }
        return redirect('/ressource_liste');
    }
}
