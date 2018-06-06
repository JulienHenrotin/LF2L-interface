
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

    <form  action="/ressource" id="personneForm" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}


            <p>Nom de la ressouce :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="nom"></p>
            <p>Model :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="model"></p>
            <p>Image :</p>
        <p> <input type="file" name="image" accept="image/*" capture /></p>
            <p>Date d'acquisition :</p>
        <p><input class="w3-input w3-border w3-round-large" type="date" name="date"></p>
            <p>Prix :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="prix"></p>
            <p>Quantité : (nombre de licence pour les logiciels)</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="quantite"></p>
            <p>Fournisseur :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="fournisseur"></p>
            <p>Numéro de facture :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="num_facture"></p>
            <p>Type :</p>
        <select id="type" onchange="affiche_role(value)">

            <option></option>
            <option value="materiel_bureau">Materiel de bureau</option>
            <option value="outil_numerique">Outil numerique(ordinateur,casque VR,...)</option>
            <option value="logiciel">Logiciel</option>
            <option value='materiaux_consommable'>Materiaux Consommable</option>
            <option value='machine'>Machine</option>
            <option value='piece_maintenance'>Piece Maintenance</option>

        </select>
        <input id="type2" type="hidden" name="type" value="">

        <p><input  type="submit" value="envoyer" ></p>
    </form>

</div>

</div>



<script>
function affiche_role(role) {
    document.getElementById('type2').value = role;
}



</script>
