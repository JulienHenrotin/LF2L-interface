<?php
header("Access-Control-Allow-Origin: *");
$ressource = $_GET['ressource'];
$leID = $_GET['leID'];?>

<p1 id='<?php echo $leID; ?>'>
    <?php echo $ressource; ?>
    <button  class='w3-button w3-circle w3-red' type='button' onclick='suppre_tache("<?php echo $leID; ?>",this.parentNode.getAttribute("id"))'> Supprimer</button><br>
</p1>

