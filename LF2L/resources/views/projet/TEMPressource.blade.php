<?php
header("Access-Control-Allow-Origin: *");
$ressource = $_GET['ressource'];
$leID = $_GET['leID'];?>

<p1 id='<?php echo $leID; ?>'>
    <?php echo $ressource; ?>
    <button  class='w3-button w3-circle w3-red' type='button' onclick='suppre_resource("<?php echo $leID; ?>",this.parentNode.getAttribute("id"))'><i class='fa fa-close'></i>Supprimer</button><br>
</p1>

