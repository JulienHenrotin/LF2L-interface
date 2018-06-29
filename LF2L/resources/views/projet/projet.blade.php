@include('header')
@include('verifConnexion')


<h1>Suivi du projet</h1>

<?php
echo "<h2> Nom du projet : ".$nomprojet."</h2>";


use App\projet;
use App\projet_const_proc;
use App\activite_instanciee;
use App\activite;

$idprojet = projet::select('id_projet')->where('nom_projet', $nomprojet)->get()[0];
//dump($idprojet->id_projet);
$id_processus = projet_const_proc::select('id_processus')->where('id_projet', $idprojet->id_projet)->get();
//dump($id_processus);
foreach ($id_processus as $id_processu):
    //dump($id_processu->id_processus);
    $id_activite = activite_instanciee::select('id_activite')->where('id_processus',$id_processu->id_processus)->get()[0];
//    dump($id_activite);
    $activitedetail = activite::where('id_activite',$id_activite->id_activite)->get();
    dump($activitedetail);

endforeach;
?>

@include('footer')