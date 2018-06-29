<?php
header("Access-Control-Allow-Origin: *");

//dd(dump($financements));
?>
        <!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="LF2L/public/image/favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/creationProjet.js') }}"></script>
    <!--importation des librairies et scripts -->
    <title>Création de projet</title>
    <link rel="shortcut icon" href="image/favicon.ico">
</head>

<body>
@include('header')
<div class="w3-col" style="width:20%"><p></p></div>
<div class="w3-col" style="width:60%">
    <div class="w3-container">
        <h2>Création d'un nouveau projet</h2>
    </div>
    <form method="post" id="formulaire" action="http://lf2l/creationProjet" name="formulaire">
    {{ csrf_field() }} <!-- token de sécurité imposé par laravel pour les formulaires-->
        <p>Nom du projet : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="titre">

        <p>Date de lancement du projet : </p>
            <input class="w3-input w3-border w3-round-xxlarge" type="date" name="date_pu">

        <p>Personnes participantes : </p>

    </form>

    <div class='w3-dropdown-hover'>

        <div id='conteneur' class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
            <!-- lis la BDD pour afficher les source de financement déja connues -->
            <?php foreach ($personne as $onePER ): ?>
            <a class='100 w3-bar-item w3-button'
               onclick="ajout_financement('<?php echo $onePER->Nom;?>','<?php echo $onePER->prenom;?>')"><?php echo $onePER->prenom ." ". $onePER->Nom;?> </a>
            <?php endforeach; ?>
        </div>

    </div>

    <button onclick='myFunctiondropbox("conteneur")' class='w3-button w3-grey' id="drop">
        Personnes participantes
    </button>

    <div id="truc"></div>
    <input onclick="traitementArgent()" type="submit"
           class="w3-button w3-btn w3-round-xxlarge w3-margin w3-green w3-hover-purple"
           value="Créer le projet" form="formulaire">
</div>

<div class="w3-col" style="width:20%"><p></p></div>

</body>
{{--@include('footer')--}}
@include('verifConnexion')
</html>
