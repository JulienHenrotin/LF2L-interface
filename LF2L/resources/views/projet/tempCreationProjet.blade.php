<?php
$leID=$_GET['leID'];
header("Access-Control-Allow-Origin: *");
echo "<p  id={$leID} name='pp'>".$_GET['source']."<button  type='button' onclick='suppre_finance({$leID})'> </button> <input type='text' placeholder='montant de la subvention'> € </p>";
?>
