<?php
$statut = Session::get('personne.statut');
//recupération du statut de la personne connecté
if ($statut != 'superAdmin') {
    echo "<script>
    window.location.replace('http://lf2l/login');
</script>";
    // renvoi sur la page de connexion si la personne n'est pas connectée en super Admin
}
?>