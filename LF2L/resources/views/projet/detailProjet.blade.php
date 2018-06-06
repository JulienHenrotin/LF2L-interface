<?php
header("Access-Control-Allow-Origin: *");
//la partie en php instancie sous forme d'objets les taables de la BDD qu'on a besoin
//les tables sont mises sous forme de string grace au foreah et aux concaténations
//cela permet de pouvoir les envoyer par POST
//$tables = \App\resources::all();
$resources = "  ";
foreach ($resourcesBDD as $table) {
    $resources = $resources . $table->type . ";";
}
//$tablesP = \App\personne::all();
$personne = "";
foreach ($tablesP as $tableP) {
    $personne = $personne . $tableP->Nom . " ";
    $personne = $personne . $tableP->prenom . ";";
}

//$tableTache = \App\taches::all();
$tache = "";
foreach ($tableTache as $tache1) {
    $tache = $tache . $tache1->nom_tache . ";";
}
//dump($resourcesBDD);
//dump($tablesP);
//dump($tableTache);
?>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/detailProjet.js') }}"></script>
</head>
<body>
<div class="w3-row-padding">
    <div class="w3-half">
        <div id="main" class="w3-container">
            <h2>Détails du projet : <?php echo session()->get('projet.nom');?> </h2>
            <p>C'est ici que vous construisez les étapes de votre projets</p>
            <!-- Premiere activité : les suivantes sont généré par de l'AJAX-->
            <button onclick="myFunction('1 form')" class="w3-btn w3-block w3-black w3-left-align">Activité 1</button>
            <div id="1 form" class="w3-container w3-hide">
                <div class='w3-container'>
                    <input class="w3-input w3-border w3-round-large" type="text" placeholder="nom de l'activité"
                           id="nomACT">
                    <select class="w3-select w3-border" name="option" id="1 option">
                        <option value="" disabled selected>Processus</option>
                        <?php
                        foreach ($processus as $unProcessus):
                        ?>
                        <option value="<?php echo $unProcessus->nom_processus; ?>"> <?php echo $unProcessus->nom_processus ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class='w3-dropdown-click'>
                        <button onclick='myFunctiondropbox(300)' class='w3-button w3-black'>
                            Resources
                        </button>
                        <div id='300' class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
                            <?php foreach ($resourcesBDD as $table): ?>
                            <a class='100 w3-bar-item w3-button'
                               onclick="ajoutRessource('<?php echo $table->type;?>' , recupID(this.getAttribute('class')))"><?php echo $table->type;?> </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class='w3-container'>
                        <div id='100'
                             class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                            <p>Liste de ressources</p>
                        </div>
                    </div>
                </div>

                <!-- ======================================================================================
                            ===================== AJOUT PERSONNES ================================================-->
                <div class='w3-container'>
                    <div class='w3-dropdown-click'>

                        <button onclick='myFunctiondropbox(400)' class='w3-button w3-black'>
                            Personnes
                        </button>
                        <div id='400' class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>

                            <?php

                            foreach ($tablesP as $matchP):
                            $conca = $matchP->Nom . " " . $matchP->prenom;
                            ?>
                            <a class='200 w3-bar-item w3-button'
                               onclick="ajoutPersonne('<?php echo $conca;?>' , recupID(this.getAttribute('class')))">
                                <?php echo $conca;?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class='w3-container'>
                        <div id='200' class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                            <p>Liste des personnes participants au projet</p>
                        </div>
                    </div>

                    <!-- ======================================================================================
       ===================== AJOUT TACHES ================================================-->
                    <!-- ====================================================== -->
                    <div class='w3-container'>
                        <div class='w3-dropdown-click'>
                            <button onclick='myFunctiondropbox(700)' class='w3-button w3-black'>
                                Taches de l'activité
                            </button>
                            <div id='700' class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
                                <?php foreach ($tableTache as $match): ?>
                                <a class='600 w3-bar-item w3-button'
                                   onclick="ajoutTache('<?php echo $match->nom_tache;?>' , recupID(this.getAttribute('class')))">
                                    <?php echo $match->nom_tache;?> </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class='w3-container'>
                            <div id='600' class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                                <p>Liste de ressources</p>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <button class="w3-button w3-round w3-margin w3-blue w3-hover-purple"
                        onclick="ajoutAct('{{$resources}}','{{$personne}}', '{{$tache}}',this.parentNode.id)">
                    Sauvegarder l'activité
                    <!-- lance une fonction JS qui grace a l'ajax ajoute une activité -->
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{ URL::asset('js/detailProjet.js') }}"></script>
{{--script qui gere toute la page--}}
</html>


