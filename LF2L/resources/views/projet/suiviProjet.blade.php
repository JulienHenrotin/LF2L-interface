@include('header')
@include('verifConnexion')
<?php use App\projet;?>

<?php

foreach ($projetUser as $onprojet):

$selectProjet = projet::where('id_projet', $onprojet->id_projet)->get()[0];
?>
<?php echo "<a href='http://lf2l/projet?projetselect=".$selectProjet->nom_projet."'>" ?>
   <?php  echo $selectProjet->nom_projet;?>
</a>
</br>
<?php endforeach;?>


@include ('footer')


