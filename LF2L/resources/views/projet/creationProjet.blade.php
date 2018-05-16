<?php
header("Access-Control-Allow-Origin: *");
$financements = \App\parti_prenant::all();
?>
        <!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="LF2L/public/image/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="LF2L/public/css/formulaire.css">
    <script type="text/javascript" src="{{ URL::asset('js/creationProjet.js') }}"></script>
</head>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- <img src="/assets/img/1-Accueil/Header/UL-LF2L.svg" class="img-responsive" alt="UL-LF2L Logo"> -->
                <img src="LF2L/public/image/Logo-LF2L.png" class="img-responsive">
            </div>
        </div>
    </div>
</header>

<body class="w3-container">
<ul class="w3-navbar w3-blue">
    <li><a>Home</a></li>
    <li><a>Link 1</a></li>
    <li><a>Link 2</a></li>
    <li><a>Link 3</a></li>
</ul>
<div class="w3-col" style="width:20%"><p></p></div>
<div class="w3-col" style="width:60%">
    <div class="w3-container">
        <h2>Création d'un nouveau projet</h2>
    </div>
    <form method="post">
        {{ csrf_field() }}

        <p>Nom du projet : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="titre">

        <p>Date de lancement du projet : </p>
        <input class="w3-input w3-border w3-round-xxlarge" type="date" name="date_pu">

        <p>Source de financement : </p>
        <select class="w3-select w3-border" name="optionFinancement">
            <option value="" disabled selected>Nom de l'établissement</option>
            <?php foreach ($financements as $financement ): ?>
            <a class='w3-bar-item w3-button' onclick="ajout_financement('<?php echo $financement->nom_source;?>')"><?php echo $financement->nom_source;?> </a>
            <?php endforeach; ?>
        </select>
        <div id="ajout">
            <button type="button" onclick="ajout_financement(optionFinancement.value)"
                    class="w3-button w3-btn w3-round-xxlarge w3-margin w3-blue w3-hover-purple">
                Ajouter source de financement
            </button>
        </div>
        <div id="truc"></div>
        <button type="submit" method=post class="w3-button w3-btn w3-round-xxlarge w3-margin w3-green w3-hover-purple">
            Créer le projet
        </button>
    </form>
</div>
</div>
<div class="w3-col" style="width:20%"><p></p></div>
</body>

<footer>
    <div>
        <div>
            <div>
                <img src="LF2L/public/image/UL-LF2L.svg" class="img-fluid" alt="UL-LF2L Logo">
            </div>
            <div>
                <img src="LF2L/public/image/logo-ERPI.svg" class="img-fluid" alt="ERPI Logo">
            </div>
            <div>
                <p class="lead">Powered by LF2L team &amp; ERPI</p>
            </div>
        </div>
    </div>
</footer>
</html>
