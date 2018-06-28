<?php
$leID = $_GET['leID'];
header("Access-Control-Allow-Origin: *");
$source = $_GET['source'];
//récuperation des infos nécéssaires pour générer une source de financement
?>

<p id='<?php echo $leID;?>' name='pp'> <?php echo $source . "_"; ?>
<!--id donnée grace au compteur récupéré-->
    <button class='w3-button w3-tiny w3-circle w3-red w3-card-4' onclick='suppre_finance(<?php echo $leID; ?>)'>X
    </button> Rôle :
    <input class="w3-radio" type="radio" name="role<?php echo $leID;?>" value="pilote" onchange="ajoutRole(this.value,this.parentNode.id)" >
    <label>Pilote</label>
    <input class="w3-radio" type="radio" name="role<?php echo $leID;?>" value="invité" onchange="ajoutRole(this.value, this.parentNode.id)">
    <label>Invité</label></p>
<!--lance fonction js placé dans le fichier js lié dans la page d'orrigine -->
</p>
