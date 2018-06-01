<?php
header("Access-Control-Allow-Origin: *");
$compteur = $_GET['compteur'];
$compteur1 = $_GET['compteur1'];
$compteurResourceCarre = $_GET['compteurResourceCarre'];
$compteurPersonneCarre = $_GET['compteurPersonneCarre'];
$compteurTacheCarre = $_GET['compteurTacheCarre'];
$compteurTache = $_GET['compteurTache'];
$cpersonne = $_GET['cpersonne'];
$resources = $_GET['resources'];
$personnes = $_GET['personne'];
$taches = $_GET['tache'];
$pattern_resources = "#(.*?);#";
preg_match_all($pattern_resources, $resources, $matches_resources);
preg_match_all($pattern_resources, $personnes, $match_personnes);
preg_match_all($pattern_resources, $taches, $match_taches);
//recuperation des compteur pour attribuer les ID au éléments
// les infos venant de la bdd sont sous forme de string
// utilisations d'expressions régulieres permet de retrouver les infos souhaitées
      // echo $matches_resources;
        print_r( $matches_resources);
?>


<div class='w3-row-padding'>
    <div class='w3-container'>
        <button onclick='myFunction(<?php echo $compteur; ?>)' class='w3-btn w3-block w3-black w3-left-align'>
            Activité <?php echo $compteur - 299; ?>  </button>
        <div id="<?php echo $compteur; ?>" name='contenue' class='w3-container w3-hide'>
            <p>Parametre de l'activité</p>
            <input class="w3-input w3-border w3-round-large" type="text" placeholder="nom de l'activité">
            <br>

            <div class='w3-container'>
                <div class='w3-dropdown-click'>
                    <button onclick='myFunctiondropbox(<?php echo $compteur1; ?>)' class='w3-button w3-black'>
                        Resources
                    </button>
                    <div id='<?php echo $compteur1; ?>'
                         class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
                        <?php foreach ($matches_resources[1] as $match): ?>
                        <a class='<?php echo $compteurResourceCarre ?> w3-bar-item w3-button'
                           onclick="ajoutRessource('<?php echo $match;?>' , recupID(this.getAttribute('class')))"><?php echo $match;?> </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class='w3-container'>
                    <div id='<?php echo $compteurResourceCarre ?>'
                         class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                        <p>Liste de ressources</p>
                    </div>
                </div>
            </div>
            <!-- ======================================================================================
            ===================== AJOUT PERSONNES ================================================-->


            <div class='w3-container'>
                <div class='w3-dropdown-click'>
                    <button onclick='myFunctiondropbox(<?php echo $cpersonne; ?>)' class='w3-button w3-black'>
                        Personnes
                    </button>
                    <div id='<?php echo $cpersonne; ?>'
                         class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
                        <?php foreach ($match_personnes[1] as $matchP): ?>
                        <a class='<?php echo $compteurPersonneCarre ?> w3-bar-item w3-button'
                           onclick="ajoutPersonne('<?php echo $matchP;?>' , recupID(this.getAttribute('class')))">
                            <?php echo $matchP;?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class='w3-container'>
                    <div id='<?php echo $compteurPersonneCarre ?>'
                         class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                        <p>Liste des personnes participants au porjet</p>
                    </div>
                </div>
            </div>
            <!-- ======================================================================================
            ===================== AJOUT TACHES ================================================-->
            <!-- ====================================================== -->
            <div class='w3-container'>
                <div class='w3-dropdown-click'>
                    <button onclick='myFunctiondropbox(<?php echo $compteurTache; ?>)' class='w3-button w3-black'>
                        Taches de l'activité
                    </button>
                    <div id='<?php echo $compteurTache; ?>'
                         class='w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom'>
                        <?php foreach ($match_taches[1] as $match): ?>
                        <a class='<?php echo $compteurTacheCarre ?> w3-bar-item w3-button'
                           onclick="ajoutRessource('<?php echo $match;?>' , recupID(this.getAttribute('class')))"><?php echo $match;?> </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class='w3-container'>
                    <div id='<?php echo $compteurTacheCarre ?>'
                         class="w3-panel w3-white w3-topbar w3-bottombar w3-border-amber">
                        <p>Liste de ressources</p>
                    </div>
                </div>
            </div>
            <br>
            <button class='w3-button w3-round w3-margin w3-blue w3-hover-purple'
                    onclick='ajoutAct("<?php echo $resources ?>")'>Sauvegarder l'activité
                {{--a completer pas tout les parametre dans la fonction --}}
            </button>
        </div>
    </div>
</div>