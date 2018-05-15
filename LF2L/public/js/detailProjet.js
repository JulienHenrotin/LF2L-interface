console.log('Bonjour bienvenue sur les site du LF2L !! |||script lancé|||');
var compteur = 300;
var compteur1 = 50;
var compteurRsourceCarre=100;
var compteurResource=200;

function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
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
function ajoutAct(resources) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML += this.responseText;
        }
    };
    compteur=compteur+1;
    compteur1=compteur1+1;
    compteurRsourceCarre=compteurRsourceCarre+1;
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPnouvelleACT.blade.php?compteur="+compteur+"&compteur1="+compteur1+"&compteurResourceCarre="+compteurRsourceCarre+"&resources="+resources, true);
    xhttp.send();
}

function  ajoutRessource(ressource , value) {
    console.log("ajout de ressource dans la case : "+ value);
    var xhttp = new XMLHttpRequest();
    //var div = document.getElementById(document);
    var a = document.getElementsByTagName("p1");
    console.log("value  " +value);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPressource.blade.php?ressource="+ressource+"&leID="+a.length , true);
    xhttp.send();
}

function recupID (str)
{
    var re = /(.*?) /;
    var rere = /,.*?/;
    var resulte = str.match(re);
    return resulte[1];
}


function suppre_resource(leID ) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(leID)).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();

    console.log("ca supprime -> "+String(leID));
}