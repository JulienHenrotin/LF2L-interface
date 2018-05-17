
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

    <form  action="envoie" id="personneForm">
        {{ csrf_field() }}


            <p>Nom :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="nom"></p>
            <p>Personne :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="prénom"></p>
            <p>Couriel :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="mail"></p>
        <select id="responsable" onchange="affiche_role(value)">
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
            <p>Niveau :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Niveau"></p>
    </div>

    <div id="externe">
        <p>Organisation :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Organisation"></p>
    </div>



    <div id="enseignant_chercheur">
        <div id="enseignant_chercheur_chbx" class="w3-gray">
        <p>
            <input id="chbx_EC_off" class="w3-check" type="checkbox" onchange="hide('enseignant_chercheur_labo_chbx','chbx_EC_off','chbx_EC_on')">
            <label>Interne</label>

            <input id="chbx_EC_on" class="w3-check" type="checkbox" onchange="affiche('enseignant_chercheur_labo_chbx','chbx_EC_on','chbx_EC_off')">
            <label>Externe</label>
        </p>
        </div>
        <div id="enseignant_chercheur_labo_chbx" class="w3-gray" >
            <p>
                <input id="chbx_EC_labo_off" class="w3-check" type="checkbox" onchange="hide('enseignant_chercheur_labo','chbx_EC_labo_off','chbx_EC_labo_on')">
                <label>EC Interne</label>

                <input id="chbx_EC_labo_on" class="w3-check" type="checkbox" onchange="affiche('enseignant_chercheur_labo','chbx_EC_labo_on','chbx_EC_labo_off')">
                <label>EC Externe</label>
            </p>
        </div>
        <div id="enseignant_chercheur_labo">
            <p>Nom du labo</p>
            <p><input class="w3-input w3-border w3-round-large" type="text" name="Organisation"></p>
            <p>
                <input id="chbx_EC_labo_interne" class="w3-check" type="checkbox" onchange="check('chbx_EC_labo_interne','chbx_EC__labo_externe')">
                <label>Labo Interne</label>

                <input id="chbx_EC__labo_externe" class="w3-check" type="checkbox" onchange="check('chbx_EC__labo_externe','chbx_EC_labo_interne')">
                <label>Labo Externe</label>
            </p>

        </div>

    </div>
    <div id="doctorant">
        <p>Etablissement :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Etablissement"></p>
        <p>Debut du contrat :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="debut_contrat"></p>
        <p>Fin du contrat :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="fin_contrat"></p>

        <select id="responsable" >
                <?php
                foreach ($personnes as $personne){
                    foreach ($enseignants_chercheur as $enseignant_chercheur){
                        if ($personne->id_personne == $enseignant_chercheur->id_personne){
                        echo "<option value='".$personne -> prenom."'>".$personne -> prenom;
                        }
                        }
                    }
//                foreach ($personnes as $personne){
//                    foreach ($externes as $externe){
//                        if ($personne->id_personne == $externe->id_personne){
//                            echo "<option value='".$personne -> prenom."'>".$personne -> prenom;
//                        }
//                    }
//                }
                    ?>
        </select>
        <p>Nom du labo</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="Organisation"></p>
        <p>
            <input id="chbx_labo_interne" class="w3-check" type="checkbox" onchange="check('chbx_labo_interne','chbx_labo_externe')">
            <label>Labo Interne</label>

            <input id="chbx_labo_externe" class="w3-check" type="checkbox" onchange="check('chbx_labo_externe','chbx_labo_interne')">
            <label>Labo Externe</label>
        </p>
        <div id="choix_doctorant"  class="w3-gray">
        <p>
            <input id="chbx_CIFRE" class="w3-check" type="checkbox" onchange="hide('doctorant_entreprise','chbx_CIFRE','chbx_MESNR')">
            <label>CIFRE</label>

            <input id="chbx_MESNR" class="w3-check" type="checkbox" onchange="affiche('doctorant_entreprise','chbx_MESNR','chbx_CIFRE')">
            <label>MESNR</label>
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
    document.getElementById('enseignant_chercheur_labo_chbx').style.display = "none";
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
$('#personneForm').submit(function(event) {

    // Stop la propagation par défaut
    event.preventDefault();

    // Récupération des valeurs
    var $form = $(this),
        term1 = $form.find( "input[name='nom']" ).val(),
        term2 = $form.find( "input[name='prénom']" ).val(),
        term3 = $form.find( "input[name='mail']" ).val(),

        url = $form.attr( "action" );

    // Envoie des données
    $.post( url, { s: term1 });
    // Reception des données et affichage



})

</script>
<script>hide_all()</script>