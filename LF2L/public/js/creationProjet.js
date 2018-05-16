console.log("script lancé deuis le fichier JS");
var verifFinance =[];

function ajout_financement(source) {
    var xhttp = new XMLHttpRequest();
    var div = document.getElementById("truc");
    var a = div.getElementsByTagName("p");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("truc").innerHTML += this.responseText;
            console.log("sa passe");
        }
    };

    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if(verifFinance.indexOf(source) == -1)
    {
        verifFinance.push(source);
        console.log("=======================");
        console.log("tableau des sources  --> " + verifFinance);
        console.log("=======================");
    }
    else
    {
        alert("vous en pouvez pas ajouter deux fois la meme source de financement pour un même projet ! ");
        return;
    }
    console.log("=======================");
    console.log("tableau des resources --> " + verifFinance);
    console.log("=======================");

    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/tempCreationProjet.blade.php?source="+source+"&leID="+a.length, true);
    xhttp.send();
}

function suppre_finance(leID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(leID).innerHTML = this.responseText;
        }
    };
    var trouver =document.getElementById(leID).innerText;
    console.log("=======================");
    console.log("tableau financement --> " + verifFinance);
    console.log("=======================");
    console.log(trouver);
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    verifFinance.splice(resulte[1],1);
    console.log("=======================");
    console.log("tableau des financement --> " + verifFinance);
    console.log("=======================");


    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();

    console.log("ca supprime");
}

function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}