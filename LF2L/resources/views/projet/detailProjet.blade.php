<?php
header("Access-Control-Allow-Origin: *");

$tables = \App\resources::all();
$resources = "  ";
foreach ($tables as $table) {
    $resources = $resources . $table->type . ";";
}
$tablesP = \App\personne::all();
$personne= "";
foreach ($tablesP as $tableP)
    {
        $personne = $personne . $tableP->Nom . " ";
        $personne = $personne . $tableP->prenom . ";";
    }

$tableTache = \App\taches::all();
$tache= "";
foreach ($tableTache as $tache1)
{
    $tache = $tache . $tache1->nom_tache . ";";
}
?>



        <!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-row-padding">
    <div class="w3-half">
        <div id="main" class="w3-container">
            <h2>Détails du projet</h2>
            <p>C'est ici que vous construisez les étapes de votre projets</p>

            <button onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align">Activité 1</button>
            <div id="Demo1" class="w3-container w3-hide">
                <div class='w3-container'>
                    <div class='w3-dropdown-click'>
                        <button onclick='myFunctiondropbox(300)' class='w3-button w3-black'>
                            Resources
                        </button>
                        <div id='300'
                             class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>

                            <?php foreach ($tables as $table): ?>
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
                <button class="w3-button w3-round w3-margin w3-blue w3-hover-purple"
                        onclick="ajoutAct('{{$resources}}','{{$personne}}', '{{$tache}}')">Sauvegarder l'activité
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{ URL::asset('js/detailProjet.js') }}"></script>
</html>


