<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body>
<?php
use Illuminate\Support\Facades\Session;
if (Session::get('personne.nom') != null) {
    echo "Vous etes connecté " . Session::get('personne.nom') . " " . Session::get('personne.prenom') . ". Vous etes identifié en tant que " . Session::get('personne.statut');
    $boutonLG = 'logout';
} else {
    $boutonLG = 'login';
}


?>
<div class="w3-container">

    <form method="post">
        {{ csrf_field() }}
        <h1> Bienvenue sur le site du LF2L ! </h1>
        <input type="submit" class="w3-button w3-border w3-margin w3-blue w3-hover-purple" value="Liste de nos projets"
               name="Listedenosprojets">
        <input type="submit" class="w3-button w3-border w3-margin w3-blue w3-hover-purple" value="Liste des produits"
               name="Listedesproduits">
        <input type="submit" class="w3-button w3-border w3-margin w3-blue w3-hover-purple" value="Mes projets"
               name="Mesprojets">
        <input type="submit" class="w3-button w3-border w3-margin w3-blue w3-hover-purple" value="Creer un projet"
               name="Creerunprojet">
        <input type="submit" class="w3-button w3-border w3-margin w3-blue w3-hover-purple"
               value="<?php echo $boutonLG;?>" name="<?php echo $boutonLG;?>">
    </form>
</div>
<?php
$test = session::get('personne');
print_r($test);
?>
</body>

</html>
