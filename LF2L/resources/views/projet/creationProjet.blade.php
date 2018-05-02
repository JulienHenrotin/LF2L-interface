<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<div class="w3-col" style="width:20%"><p></p></div>
<div class="w3-col" style="width:60%">
    <div class="w3-container">
        <h2>Création d'un nouveau projet</h2>

    </div>
    <form method="post">
        {{ csrf_field() }}

        <p>Titre de la thèse : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="titre">

        <p>Date de publication : </p>
        <input class="w3-input w3-border w3-round-xxlarge" type="date" name="date_pu">

        <p>Source de financement : </p>
        <select class="w3-select w3-border" name="optionFinancement">

            <option value="" disabled selected>Nom de l'établissement</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>

        </select>
        <input type="button" onclick="ajout_financement(optionFinancement.value)">

        <div id="truc">aaaaa <br> </div>

    </form>


</div>

<script>
    function ajout_financement(source) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("truc").innerHTML += this.responseText;
            }
        };
        xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/tempCreationProjet.blade.php?source=" + source, true);
        xhttp.send();
    }


    function myFunction() {
        var x = document.getElementById("demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>
</div>
<div class="w3-col" style="width:20%"><p></p></div>
</body>
</html>
