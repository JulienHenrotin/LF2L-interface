console.log("script lancé depuis le fichier JS");
var verifFinance = [];
var argent = new Object();
// tableau pour stocker de maniere temporaire
// les sources de finnacements et la sommes qui leur correspond

function ajout_financement(nom, prenom) {
    // fonction qui fait appel a l'AJAX -> permet d'actualiser une partie de la page
    // sans rechargé toute la page -> sert pour toutes les parties dynamique du site
    //ou nous faisons appel à la BDD
    var xhttp = new XMLHttpRequest();
    var div = document.getElementById("truc");
    var a = div.getElementsByTagName("p");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //ajoute ce que l'utilisateur a selectionner
            document.getElementById("truc").innerHTML += this.responseText;
        }
    };

    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if (verifFinance.indexOf(nom+" "+prenom) == -1) {
        verifFinance.push(nom+" "+prenom);
    }
    else {
        alert("vous en pouvez pas ajouter deux fois la meme personne pour un même projet ! ");
        return;
    }
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/tempCreationProjet.blade.php?source=" + prenom+" "+nom + "&leID=" + a.length, true);
    xhttp.send();
    //envois d'une requette pour aller chercher la partie de html a rajouter quand l'utilisateur ajoute un élément
}

function suppre_finance(leID) {
    // meme principe que l'ajout mais on remplace par du vide la partie selectionner
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(leID).innerHTML = this.responseText;
        }
    };
    var trouver = document.getElementById(leID).innerText;
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    var resulte1 = resulte[1];
    verifFinance.splice(resulte[1], 1);
    delete argent[resulte1];
    console.log(argent);
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();
}

function myFunction() {
    //fonction qui vient de W3school -> partie de style animé
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function myFunctiondropbox(id) {
    //fonction qui vient de W3school -> anime les dropbox

    var x = document.getElementById(id);
    console.log("flaggg1");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        console.log("flaggg2");
    } else {
        x.className = x.className.replace(" w3-show", "");
        console.log("flaggg3");
    }
}


function ajoutRole(value, source) {
    // quand l'utilisateur ecris un montant de financement
    // --> ajoute dans le tableau la somme correspondant à la source
    var nomSource = document.getElementById(source).innerText;
    var re = /(.*?)_/;
    var resulte = nomSource.match(re);
console.log("======"+argent);
    console.log("role est:  " + value + " et la personne est : " + resulte[1]);
    argent[resulte[1]] = value;
    console.log(argent);
}


function traitementArgent() {
    var argentString = ""
    for (var key in argent) {
        console.log("argent --->  " + argentString)
        argentString = argentString + key + "," + argent[key] + ";"
    }
    var select = document.getElementById('formulaire');

   // var ajout = "{{csrf_field()}} <input type='hidden' value='" + argentString + "' name='argentcache' form='formulaire'>";
    select.insertAdjacentHTML('beforeend', "{{csrf_field()}} <input type='hidden' value='" + argentString + "' name='argentcache' form='formulaire'>");
    select.submit();

    select = document.getElementById('formulaire');
    console.log(select);
}


