
<html>

<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<body>
<div class="w3-row-padding">
<div class="w3-half">

    <form  action="http://localhost/LF2L-interface/LF2L/public/personne/envoie" id="personneForm">
        {{ csrf_field() }}


            <p>Nom :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="nom"></p>
            <p>Personne :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="prénom"></p>
            <p>Mail :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="mail"></p>
        <select id="role_personne" onchange="affiche_role(value)">
            <option value="role">Role</option>
            <option value="permanent">Permanent</option>
            <option value='etudiant'>Etudiant</option>
            <option value='externe'>Externe</option>
            <option value='enseignant_chercheur'>Enseignant Chercheur</option>
            <option value='doctorant'>Doctorant</option>
            <option value='client' >Client</option>
        </select>

    <div id="client"></div>
    <div id="role"></div>
    <div id="permanent" class="w3-gray">
        <p>
            <input id="inge" class="w3-check" type="checkbox" onchange="check('inge','tech')">
            <label>Ingenieur</label>

            <input id="tech" class="w3-check" type="checkbox" onchange="check('tech','inge')">
            <label>Technicien</label>
        </p>
    </div>


    <div id="etudiant">
            <p>Etablissement :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Etablissement"></p>
        <select id="niveau">
            <option value="niveau">niveau</option>
            <option value="primaire">primaire</option>
            <option value='college'>college</option>
            <option value='lycee'>lycee</option>
            <option value='L1'>L1</option>
            <option value='L2'>L2</option>
            <option value='L3' >L3</option>
            <option value='M1' >M1</option>
            <option value='M2' >M2</option>
        </select>
    </div>

    <div id="externe">
        <p>Organisation :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Organisation"></p>
        <p>Statut :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Statut"></p>
    </div>



    <div id="enseignant_chercheur">

        <div id="enseignant_chercheur_labo_chbx" class="w3-gray" >
            <p>
                <input id="chbx_EC_labo_interne" class="w3-check" type="checkbox" onchange="hide('enseignant_chercheur_labo','chbx_EC_labo_interne','chbx_EC_labo_externe')">
                <label>EC Interne</label>

                <input id="chbx_EC_labo_externe" class="w3-check" type="checkbox" onchange="affiche('enseignant_chercheur_labo','chbx_EC_labo_externe','chbx_EC_labo_interne')">
                <label>EC Externe</label>
            </p>
        </div>
        <div id="enseignant_chercheur_labo">
            <p>Nom du labo</p>
            <p><input class="w3-input w3-border w3-round-large" type="text" name="labo_ec"></p>

        </div>

    </div>
    <div id="doctorant">
        <p>Etablissement :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Etablissement_doc"></p>
        <p>Debut du contrat :</p>
        <p><input class="w3-input w3-border w3-round-large" type="date" name="debut_contrat"></p>
        <p>Fin du contrat :</p>
        <p><input class="w3-input w3-border w3-round-large" type="date" name="fin_contrat"></p>

        <select id="responsable" >
            <option value="responsable">responsable</option>
            <?php
            foreach ($personnes as $personne){
                foreach ($enseignants_chercheur as $enseignant_chercheur){
                    if ($personne->id_personne == $enseignant_chercheur->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
                foreach ($personnes as $personne){
                foreach ($externes as $externe){
                    if ($personne->id_personne == $externe->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
            ?>
        </select><br><br>
        <select id="coresponsable" >
            <option value="coresponsable">coresponsable</option>
            <?php
            foreach ($personnes as $personne){
                foreach ($enseignants_chercheur as $enseignant_chercheur){
                    if ($personne->id_personne == $enseignant_chercheur->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
            foreach ($personnes as $personne){
                foreach ($externes as $externe){
                    if ($personne->id_personne == $externe->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
            ?>
        </select>(facultatif)<br><br>
        <select id="coresponsable2" >
            <option value="coresponsable">coresponsable</option>
            <?php
            foreach ($personnes as $personne){
                foreach ($enseignants_chercheur as $enseignant_chercheur){
                    if ($personne->id_personne == $enseignant_chercheur->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
            foreach ($personnes as $personne){
                foreach ($externes as $externe){
                    if ($personne->id_personne == $externe->id_personne){
                        echo "<option value='".$personne -> prenom." ".$personne -> Nom."'>".$personne -> prenom." ".$personne -> Nom."</option>";
                    }
                }
            }
            ?>
        </select>(facultatif)
        <p>Nom du labo</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="labo_doc"></p>
        <p>
            <input id="chbx_labo_interne" class="w3-check" type="checkbox" onchange="check('chbx_labo_interne','chbx_labo_externe')">
            <label>Labo Interne</label>

            <input id="chbx_labo_externe" class="w3-check" type="checkbox" onchange="check('chbx_labo_externe','chbx_labo_interne')">
            <label>Labo Externe</label>
        </p>
        <div id="choix_doctorant"  class="w3-gray">
        <p>
            <input id="chbx_MESNR" class="w3-check" type="checkbox" onchange="hide('doctorant_entreprise','chbx_MESNR','chbx_CIFRE')">
            <label>MESNR</label>

            <input id="chbx_CIFRE" class="w3-check" type="checkbox" onchange="affiche('doctorant_entreprise','chbx_CIFRE','chbx_MESNR')">
            <label>CIFRE</label>
        </p>

            <div></div>
        </div>
        <div id="doctorant_entreprise">
            <p>Entreprise :</p>
            <p><input class="w3-input w3-border w3-round-large" type="text" name="entreprise"></p>
        </div>


    </div>


            <p><input type="submit" value="envoyer" ></p>
    </form>
</div>
</div>


<script>
function affiche_role(role) {
    hide_all();
    document.getElementById(role).style.display = "";
}

function hide_all() {

    document.getElementById('permanent').style.display = "none";
    document.getElementById('etudiant').style.display = "none";
    document.getElementById('externe').style.display = "none";
    document.getElementById('enseignant_chercheur').style.display = "none";
    document.getElementById('enseignant_chercheur_labo').style.display = "none";
    document.getElementById('doctorant').style.display = "none";
    document.getElementById('doctorant_entreprise').style.display = "none";


}
function affiche(role,chbx,chbx2) {
    console.log(chbx);
    console.log(chbx2);
    var checkbox = document.getElementById(chbx);
    var checkbox2 = document.getElementById(chbx2);

        if(checkbox.checked){
            document.getElementById(role).style.display = "";
            checkbox2.checked=false
        }

}
function hide(x,chbx,chbx2) {
    console.log(chbx);
    console.log(chbx2);
    var checkbox = document.getElementById(chbx);
    var checkbox2 = document.getElementById(chbx2);

    if(checkbox.checked){
        document.getElementById(x).style.display = "none";
        checkbox2.checked=false
    }


}

function check(chbx,chbx2) {
    console.log(chbx);
    console.log(chbx2);
    var checkbox = document.getElementById(chbx);
    var checkbox2 = document.getElementById(chbx2);

    if(checkbox.checked){
        checkbox2.checked=false
    }


}
function verif_check(nom_chbx){
    console.log(nom_chbx)
    var x = '0';
    var chbx = document.getElementById(nom_chbx);

    if(chbx.checked){
        x='1'
    }
    return x
}
$('#personneForm').submit(function(event) {

    // Stop la propagation par défaut
    event.preventDefault();

    // Récupération des valeurs
    var inge = verif_check('inge')
    var tech = verif_check('tech')


    var chbx_EC_labo_interne = verif_check('chbx_EC_labo_interne')
    var chbx_EC_labo_externe = verif_check('chbx_EC_labo_externe')
    var chbx_labo_interne = verif_check('chbx_labo_interne')
    var chbx_labo_externe = verif_check('chbx_labo_externe')
    var chbx_CIFRE = verif_check('chbx_CIFRE')
    var chbx_MESNR = verif_check('chbx_MESNR')

    var role = document.getElementById('role_personne').value
    var Niveau = document.getElementById('niveau').value
    var responsable = document.getElementById('responsable').value
    var coresponsable = document.getElementById('coresponsable').value
    var coresponsable2 = document.getElementById('coresponsable2').value

    console.log(role)
    var $form = $(this),

        nom = $form.find( "input[name='nom']" ).val(),
        token = $form.find( "input[name='_token']" ).val(),
        prenom = $form.find( "input[name='prénom']" ).val(),
        mail = $form.find( "input[name='mail']" ).val(),
        Etablissement = $form.find( "input[name='Etablissement']" ).val(),
        Statut = $form.find( "input[name='Statut']" ).val(),
        Organisation = $form.find( "input[name='Organisation']" ).val(),
        labo_ec = $form.find( "input[name='labo_ec']" ).val(),
        Etablissement_doc = $form.find( "input[name='Etablissement_doc']" ).val(),
        debut_contrat = $form.find( "input[name='debut_contrat']" ).val(),
        fin_contrat = $form.find( "input[name='fin_contrat']" ).val(),
        labo_doc = $form.find( "input[name='labo_doc']" ).val(),
        entreprise = $form.find( "input[name='entreprise']" ).val(),

        url = $form.attr( "action" );

    // Envoie des données
    $.post( url,{'_token': token,'nom':nom,'prenom':prenom,'mail':mail,'inge':inge,'tech':tech,'role':role,'entreprise':entreprise,
        'labo_doc':labo_doc,'fin_contrat':fin_contrat,'debut_contrat':debut_contrat,'Etablissement_doc':Etablissement_doc,
        'labo_ec':labo_ec,'Organisation':Organisation,'Niveau':Niveau,'Etablissement':Etablissement,'chbx_MESNR':chbx_MESNR,
        'chbx_CIFRE':chbx_CIFRE,'chbx_labo_externe':chbx_labo_externe,'chbx_labo_interne':chbx_labo_interne,
        'chbx_EC_labo_externe':chbx_EC_labo_externe, 'chbx_EC_labo_interne':chbx_EC_labo_interne,'Statut':Statut,
        'responsable':responsable,'coresponsable':coresponsable,'coresponsable2':coresponsable2
    })
    .done(function() {
        //window.location.replace('http://localhost/LF2L-interface/LF2L/public/personne/envoie')
    });


});

</script>
<script>hide_all()</script>