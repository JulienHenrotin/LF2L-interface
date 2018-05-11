console.log('Bonjour bienvenue sur les site du LF2L !! |||script lancé|||');
var compteur = 1;
var compteur1 = 50;
var compteurRessource=100;

function myFunction(id) {
    var x = document.getElementById(id);
    console.log(x);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}


function ajoutAct(resources) {
    console.log("ca ajoute une activité");
    console.log(resources);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML += this.responseText;
        }
    };
    compteur=compteur+1;
    compteur1=compteur1+1;
    compteurRessource=compteurRessource+1;
    console.log("le compteur est a : "+compteur);
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPnouvelleACT.blade.php?compteur="+compteur+"&compteur1="+compteur1+"&compteurRessource="+compteurRessource+"&resources"+resources, true);
    xhttp.send();
}


function myFunctiondropbox(id)
{
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function  ajoutRessource(ressource) {
    console.log("ajout de ressource "+compteurRessource);
    var xhttp = new XMLHttpRequest();
    var div = document.getElementById(compteurRessource);
    var a = div.getElementsByTagName("a");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(compteurRessource).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPressource.blade.php?ressource="+ressource+"&leID="+a.length , true);
    xhttp.send();
}