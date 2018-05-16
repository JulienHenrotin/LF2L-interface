console.log('Bonjour bienvenue sur les site du LF2L !! |||script lancé|||');
var compteur = 301;
var compteur1 = 51;
var compteurResourceCarre=101;
var compteurPersonneCarre=201;
var cpersonne = 401;
var averifresource = [];
var averifPersonne = [];

function myFunction(id) {
    console.log("menu deployant -> " +id);
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function myFunctiondropbox(id)
{
    console.log("dropboxe -> "+id);
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
function ajoutAct(resources , personnes) {
    console.log("les personnse envoyés sont -> "+personnes);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML += this.responseText;
        }
    };
    compteur=compteur+1;
    compteur1=compteur1+1;
    compteurResourceCarre=compteurResourceCarre+1;
    compteurPersonneCarre= compteurPersonneCarre+1;
     cpersonne = cpersonne+1;
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPnouvelleACT.blade.php?compteur="+compteur+"&compteur1="+compteur1+"&compteurResourceCarre="+compteurResourceCarre+"&resources="+resources
        +"&compteurPersonneCarre="+compteurPersonneCarre+"&cpersonne="+cpersonne+"&personne="+personnes, true);
    xhttp.send();
}

function  ajoutRessource(ressource , value) {
    var xhttp = new XMLHttpRequest();
    var a = document.getElementsByTagName("p1");
    // var averif = averif.match()
    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if(averifresource.indexOf(ressource) == -1)
    {
        averifresource.push(ressource);
        console.log("verif ok");
    }
    else
    {
        console.log("verif"+averifresource.indexOf(ressource));
        alert("vous en pouvez pas ajouter deux fois la meme resource ! ");
        return;
    }
    console.log("=======================");
    console.log("tableau des resources --> " + averifresource);
    console.log("=======================");
    //=========================================
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPressource.blade.php?ressource="+ressource+"&leID="+a.length+2 , true);
    xhttp.send();
}


function  ajoutPersonne(ressource , value) {
    var xhttp = new XMLHttpRequest();
    var a = document.getElementsByTagName("p1");

    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if(averifPersonne.indexOf(ressource) == -1)
    {
        averifPersonne.push(ressource);
        console.log("verif ok");
    }
    else
    {
        console.log("verif"+averifPersonne.indexOf(ressource));
        alert("Vous en pouvez pas ajouter deux fois la meme personne dans une même activité ! ");
        return;
    }
    console.log("=======================");
    console.log("tableau des personnes --> " + averifPersonne );
    console.log("=======================");
    //=========================================
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPpersonne.blade.php?ressource="+ressource+"&leID="+a.length+2 , true);
    xhttp.send();
}


function recupID (str)
{
    var re = /(.*?) /;
    var resulte = str.match(re);
    return resulte[1];
}


function suppre_resource(leID) {
    // A FAIRE : suprimer du tableau quand on supre ------ monTableau.splice(0, 2);
    var trouver =document.getElementById(leID).innerText;
    console.log("=======================");
    console.log("tableau des resources --> " + averifresource);
    console.log("=======================");
    console.log(trouver);
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    averifresource.splice(resulte[1],1);
    console.log("=======================");
    console.log("tableau des resources --> " + averifresource);
    console.log("=======================");
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



function suppre_personne(leID) {
    var trouver =document.getElementById(leID).innerText;
    console.log("premier tableau -> "+averifPersonne);
    console.log(trouver);
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    console.log("reultat -> "+resulte[1])
    averifPersonne.splice(resulte[1],1);
    console.log("tableau clean -> "+averifPersonne);
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