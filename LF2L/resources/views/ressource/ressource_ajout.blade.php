
<html>

<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<body>
<div class="w3-row-padding" style="padding-left: 5%;width: 100%;">
<div class="w3-half">

    <form  action="/ressource" id="personneForm" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}



        <p><input class="w3-input w3-border w3-round-large" type="hidden" name="nom" value="{{$type}}"></p>
            <p>Prix :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="prix"></p>
            <p>Quantité : (nombre de licence pour les logiciels)</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="quantite"></p>
            <p>Fournisseur :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="fournisseur"></p>
            <p>Numéro de facture :</p>
        <p><input class="w3-input w3-border w3-round-large" type="text" name="num_facture"></p>


        <p><input  type="submit" value="envoyer" ></p>
    </form>
</div>
</div>



<script>
function affiche_role(role) {
    document.getElementById('type2').value = role;
}


// $('#personneForm').submit(function(event) {
//
//     // Stop la propagation par défaut
//     event.preventDefault();
//
//     //Récupération des valeurs
//
//
//     var type = document.getElementById('type').value
//
//     var $form = $(this),
//
//         nom = $form.find( "input[name='nom']" ).val(),
//         token = $form.find( "input[name='_token']" ).val(),
//         image = $form.find( "input[name='image']" ).val(),
//         date = $form.find( "input[name='date']" ).val(),
//         prix = $form.find( "input[name='prix']" ).val(),
//         quantite = $form.find( "input[name='quantite']" ).val(),
//         fournisseur = $form.find( "input[name='fournisseur']" ).val(),
//         num_facture = $form.find( "input[name='num_facture']" ).val(),
//         model = $form.find( "input[name='model']" ).val(),
//
//
//
//
//
//         url = $form.attr( "action" );
//
//     // Envoie des données
//     $.post( url,{'form-data':'','_token': token,'nom':nom,'image':image,'date':date,'prix':prix,'quantite':quantite,'fournisseur':fournisseur,
//         'num_facture':num_facture,'model':model,'type':type
//     })
//     .done(function() {
//         //window.location.replace('http://localhost/LF2L-interface/LF2L/public/personne/envoie')
//     });
//
//
// });

</script>
