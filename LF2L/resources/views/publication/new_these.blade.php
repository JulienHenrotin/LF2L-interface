<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<div class="w3-container">
    <h2>Ajout d'une nouvelle publication</h2>
    <p>type de publication: </p>


    <div class="w3-dropdown-click">
        <button class="w3-button" onclick="myFunction()">
            Type de publication <i class="fa fa-caret-down"></i>
        </button>
        <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">
            <a href="these" class="w3-bar-item w3-button">These</a>
            <a href="#" class="w3-bar-item w3-button">Link 2</a>
            <a href="#" class="w3-bar-item w3-button">Link 3</a>
        </div>
    </div>
    <form method="post">
        {{ csrf_field() }}

        <p>Titre de la thèse : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="titre">

        <p>Nom de l'auteur de la thèse : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="nom">

        <p>Prénom de l'auteur de la thèse : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="prenom">

        <p>Domaine de publication : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="dom">

        <p>Date de publication : </p>
        <input class="w3-input w3-border w3-round-xxlarge" type="date" name="date_pu">



        <p>Nom de l'établissement : </p>
        <select class="w3-select w3-border" name="option">

            <option value="" disabled selected>Nom de l'établissement</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>

        </select>
        <p>Nom juré : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="nom_jure">

        <p>Prénom juré : </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="prenom_jure">
        <input type="button" onclick="ajout_jure(prenom_jure.value)">
        <div id="truc">aaaaa</div>

    </form>


</div>

<script >
    function ajout_jure(prenom) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("truc").innerHTML += this.responseText;
            }
            };
            xhttp.open("GET", "http://localhost/LF2L-interface2/LF2L/resources/views/test.blade.php?prenom="+prenom, true);
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

</body>
</html>
