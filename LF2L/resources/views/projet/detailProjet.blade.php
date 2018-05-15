<?php
header("Access-Control-Allow-Origin: *");
//$listnomresource = array();
//foreach ($resources as $resource) {
//    array_push($listnomresource, $resource->type);
//}
//print_r($listnomresource);
$tables = \App\resources::all();
$resources = "  ";
foreach ($tables as $table) {
    $resources = $resources . $table->type . ";";
}
echo $resources;
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
                <p>Some text..</p>
                <button class="w3-button w3-round w3-margin w3-blue w3-hover-purple"
                        onclick="ajoutAct('{{$resources}}')">Sauvegarder l'activité
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{ URL::asset('js/detailProjet.js') }}"></script>
</html>


