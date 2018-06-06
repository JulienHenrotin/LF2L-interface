console.log('Bonjour bienvenue sur les site du LF2L !! |||script lancé|||');
var compteur = 301;
var compteur1 = 51;
var compteurResourceCarre = 101;
var compteurPersonneCarre = 201;
var cpersonne = 401;
var averifresource = [];
var averifPersonne = [];
var averifTache = [];
var compteurTacheCarre = 601;
var compteurTache = 701;


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// les ID de depart définis avec les compteurs ont une valeur arbitraire -> peu poser probleme si on ajoute
// BEAUCOUP d'éléments pour un meme groupe (personnes, resources , taches)


function myFunction(id) {
    // fonction venant de W3 school CSS -> anime les menus déroulants
    console.log("menu deployant -> " + id);
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function myFunctiondropbox(id) {
    // fonction venant de W3 school CSS -> anime les dropbox
    console.log("dropboxe -> " + id);
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function ajoutAct(resources, personnes, tache, id) {
    //fonction faisant appel à de l'AJAX : permet d'actualiser une partie de la page
    // sans rechargé toute la page -> sert pour toutes les parties dynamiques du site
    //ou nous faisons appel à la BDD
    //quand on ajoute une activité on cache les boutons pour supprimer les resources
    // le but est que les users modifient qu'une seule activité en meme temps
    var nbsuppre = document.getElementsByClassName('w3-button w3-circle w3-red').length;
    console.log("nbsuppre -> " + nbsuppre);
    for (var i = 0; i < nbsuppre; i++) {
        var asuppre = document.getElementById('suppre')
        asuppre.style.visibility = "hidden";
        console.log("while de suppre");
    }
    console.log("Ajout d'une activité");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML += this.responseText;
        }
    };
    compteur = compteur + 1;
    compteur1 = compteur1 + 1;
    compteurResourceCarre = compteurResourceCarre + 1;
    compteurPersonneCarre = compteurPersonneCarre + 1;
    cpersonne = cpersonne + 1;
    compteurTacheCarre = compteurTacheCarre + 1;
    compteurTache = compteurTache + 1;
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPnouvelleACT.blade.php?compteur=" + compteur + "&compteur1=" + compteur1 + "&compteurResourceCarre=" + compteurResourceCarre + "&resources=" + resources
        + "&compteurPersonneCarre=" + compteurPersonneCarre + "&cpersonne=" + cpersonne + "&personne=" + personnes
        + "&compteurTacheCarre=" + compteurTacheCarre + "&compteurTache=" + compteurTache + "&tache=" + tache
        , true);
    xhttp.send();
    //envoi de tout les compteurs pour creer tout les nouveaux éléments HTML avec un id unique
    var personneString = "";
    var resourceString = "";
    var tacheString = "";
    averifresource.forEach(function (element) {
        console.log("flaggggg");
        resourceString = resourceString + element + ";";
    })
    averifPersonne.forEach(function (element1) {
        console.log("flagggggpppp");
        personneString = personneString + element1 + ";";
    })
    averifTache.forEach(function (element2) {
        console.log("flagggggtttttt");
        tacheString = tacheString + element2 + ";";
    })
    console.log("tache ======== " + averifresource);
    console.log("personne ======= " + averifPersonne);
    console.log("ressources =========" + averifTache);
    var processus = document.getElementById("1 option").value;
    var nomACT = document.getElementById("nomACT").value;
    // var select = document.getElementById(id);
    // select.insertAdjacentHTML('beforeend', " <form method='get' id='Fressource'>{{csrf_field()}}" +
    //     "<input type='hidden' value='" + resourceString + "' name='ressource'> " +
    //     "<input type='hidden' value='" + personneString + "' name='personnes'>" +
    //     "<input type='hidden' value='" + tacheString + "' name='taches'>" +
    //     "<input type='hidden' value='" + processus + "' name='processus'>");
    // "<input type='hidden' value='" + nomACT + "' name='nomACT'>"
    // select.insertAdjacentHTML('afterend', '</form>')
    // var select2 = document.getElementById('Fressource');
    // // console.log("tache ======== "+tacheString);
    // // console.log("personne ======= "+personneString);
    // // console.log("ressources =========" + resourceString);
    // select2.submit();
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/LF2L-interface/LF2L/resources/views/projet/detailProjet.blade.php", true)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("processus=processus&nomACT=nomACT");

    averifresource = [];
    averifPersonne = [];
    averifTache = [];
}

//=================================================================================
function ajoutRessource(ressource, value) {
    var xhttp = new XMLHttpRequest();
    var a = document.getElementsByTagName("p1");
    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if (averifresource.indexOf(ressource) == -1) {
        averifresource.push(ressource);
    }
    else {
        alert("vous en pouvez pas ajouter deux fois la meme resource ! ");
        return;
    }
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPressource.blade.php?ressource=" + ressource + "&leID=" + a.length + 2, true);
    xhttp.send();
}

function ajoutPersonne(ressource, value) {
    var xhttp = new XMLHttpRequest();
    var a = document.getElementsByTagName("p1");

    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if (averifPersonne.indexOf(ressource) == -1) {
        averifPersonne.push(ressource);
    }
    else {
        alert("Vous en pouvez pas ajouter deux fois la meme personne dans une même activité ! ");
        return;
    }
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPpersonne.blade.php?ressource=" + ressource + "&leID=" + a.length + 2, true);
    xhttp.send();
}


function recupID(str) {
    var re = /(.*?) /;
    var resulte = str.match(re);
    return resulte[1];
    // permet de récuper l'ID envoyé par requette
    // nous mettons les infos sous forme de string puisque envoyer un tableau en impossible
}


function suppre_resource(leID) {
    //supprimer dans le tableau de stockage temporaire la resource
    //suppriler grace a de l'AJAX l'élément en HTML
    var trouver = document.getElementById(leID).innerText;
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    averifresource.splice(resulte[1], 1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(leID)).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();
}


function suppre_personne(leID) {
    // meme principe que plus haut
    var trouver = document.getElementById(leID).innerText;
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    averifPersonne.splice(resulte[1], 1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(leID)).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();
}

//======================================================================
//======== GESTION DES TACHES DE L ACTIVITE ============================

function ajoutTache(ressource, value) {
    var xhttp = new XMLHttpRequest();
    var a = document.getElementsByTagName("p1");
    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if (averifTache.indexOf(ressource) == -1) {
        averifTache.push(ressource);
    }
    else {
        alert("Vous en pouvez pas ajouter deux fois la meme tache dans une même activité ! ");
        return;
    }
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(value)).innerHTML += this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/TEMPtache.blade.php?ressource=" + ressource + "&leID=" + a.length + 2, true);
    xhttp.send();
}

function suppre_tache(leID) {
    var trouver = document.getElementById(leID).innerText;
    var re = /(.*?) /;
    var resulte = trouver.match(re);
    averifTache.splice(resulte[1], 1);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(String(leID)).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/vide.blade.php", true);
    xhttp.send();
}
