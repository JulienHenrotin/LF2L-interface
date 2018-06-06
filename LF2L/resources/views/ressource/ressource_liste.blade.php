<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
    form {display: inline;}
</style>
<body>
<div>
@include('header')

    <a href="/ressource"><button>Ajouter une ressource</button></a>
<input class="w3-input w3-border w3-padding" type="text" placeholder="Chercher une ressource" id="myInput" onkeyup="recherche()" style="max-Width:70%;margin-left: 15%">
<br>
<div id='liste' class="w3-container w3-row-padding " style="padding-left: 7.5%">

    @foreach($ressources as $ressource)


    <div  class="w3-card-4 w3-third w3-center div" style="width:280px;height:300px ;margin-bottom: 1%;margin-left: 1%;">
        <p class="p"><?php echo $ressource->type ?></p>
        <img src="/storage/<?php echo $ressource->img_ressources ?>"  style="max-Width:70% ;height:50%">
            <p>Quantité : <?php echo $ressource->stock ?></p>


        <p><form method="post" action="/ressource_liste/facture" >
            {{ csrf_field() }}
            <input type="hidden" name="type" value="<?php echo $ressource->type ?>">
            <input type="submit" value="Facture" >

        </form>

        <form  method="post" action="/ressource_liste/ajout">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="<?php echo $ressource->type ?>">
            <input type="submit" value="Ajouter" >

        </form>

            <button  onclick="document.getElementById('<?php echo $ressource->id_ressources ?>').style.display='block'"  >Réduire</button></p>
            <div id="<?php echo $ressource->id_ressources ?>" class="w3-modal w3-animate-opacity">
                <div class="w3-modal-content w3-card-4">
                    <header class="w3-container w3-teal">
                    <span onclick="document.getElementById('<?php echo $ressource->id_ressources ?>').style.display='none'"
                    class="w3-button w3-large w3-display-topright">&times;</span>
                        <h2>Réduire</h2>
                    </header>
                    <div class="w3-container ">
                        <br>
                        <p>Vous avez <?php echo $ressource->stock ?> <?php echo $ressource->type ?>, combien voulez vous en enlever ? </p>
                        <form  method="post" action="/ressource_liste/reduction" >
                            {{ csrf_field() }}
                        <input type="hidden" name="type" value="<?php echo $ressource->type ?>">
                        <input class="w3-center"  type="text" name="nb">
                        <input type="submit" value="Valider" >
                        </form>
                        <br>
                        <br>
                    </div>
                    <footer class="w3-container w3-teal">
                        <p> </p>
                    </footer>
                </div>
            </div>


    </div>
    @endforeach
</div>
</div>
</body>

<script>
    function recherche() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("liste");
        tr = table.getElementsByClassName('div');
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName('p')[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@include('footer')