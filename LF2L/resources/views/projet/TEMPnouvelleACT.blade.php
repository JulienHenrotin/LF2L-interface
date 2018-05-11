<?php
//namespace app;
//use LF2L\app\resources;

header("Access-Control-Allow-Origin: *");
$compteur = $_GET['compteur'];
$compteur1 = $_GET['compteur1'];
$compteurResource = $_GET['compteurRessource'];
$resources = \App\resources::all();
//print_r($resources);
        dd(var_dump($resources));


echo "
<div class='w3-row-padding'>
<div  class='w3-container'>
<button   onclick='myFunction(" . $compteur . ")' class='w3-btn w3-block w3-black w3-left-align'>Activité " . $compteur . "  </button>
<div  id=" . $compteur . " name='contenue' class='w3-container w3-hide'>
    <p>Parametre de l'activité</p>"; ?>
<input class="w3-input w3-border w3-round-large" type="text" placeholder="nom de l'activité">
<br>

<?php
echo "<div  class='w3-container'>
<div class='w3-dropdown-click'>
    <button onclick='myFunctiondropbox(" . $compteur1 . ")' class='w3-button w3-black'>Resources</button>
    <div id=" . $compteur1 . " class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>";
        var_dump($resources);
        foreach($resources as $resource){
            echo "<a href='#' class='w3-bar-item w3-button' onclick='ajoutRessource({{$resource->type}})' value='Link'>{{$resource->type}}</a>";
       }
     echo "</div>
    </div>
    <div class='w3-container'>
      <div id=" . $compteurResource . " class='w3-panel w3-white w3-topbar w3-bottombar w3-border-amber'>
        <p>Liste de ressources</p>
    </div>
</div>
</div>"; ?>
<br>
<button class='w3-button w3-round w3-margin w3-blue w3-hover-purple' onclick='ajoutAct()'>Sauvegarder l'activité>
</button>
</div>
</div>

