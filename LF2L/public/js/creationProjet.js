console.log("script lancé deuis le fichier JS");

function ajout_financement(source) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("truc").innerHTML += this.responseText;
            var div = document.getElementById("truc");
            var a = div.getElementsByTagName("p");
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/tempCreationProjet.blade.php?source="+source, true);
    // leID=" + a.length
    xhttp.send();
}

function suppre_finance(leID) {
    // var xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function () {
    //     if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById(leID).innerHTML = this.responseText;
    //     }
    // };
    // xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    // xhttp.send();

    console.log(leID);
    var parent = document.body;
    var aSupre = document.getElementById(leID);
    parent.removeChild(aSupre);
}

function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}