console.log("script lancé depuis le fichier JS");
var verifFinance = [];
var argent = new Object();
// tableau pour stocker de maniere temporaire
// les sources de finnacements et la sommes qui leur correspond

function ajout_financement(source) {
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
            console.log("sa passe");
        }
    };

    //======VERIF QU IL Y AI PAS 2 FOIS LA MEME CHOSE
    if (verifFinance.indexOf(source) == -1) {
        verifFinance.push(source);
    }
    else {
        alert("vous en pouvez pas ajouter deux fois la meme source de financement pour un même projet ! ");
        return;
    }
    xhttp.open("GET", "http://localhost/LF2L-interface/LF2L/resources/views/projet/tempCreationProjet.blade.php?source=" + source + "&leID=" + a.length, true);
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
    verifFinance.splice(resulte[1], 1);
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
    console.log("dropboxe -> " + id);
    var x = document.getElementById(id);
    console.log(x);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}


function ajoutArgent(value, source) {
    // quand l'utilisateur ecris un montant de financement
    // --> ajoute dans le tableau la somme correspondant à la source
    console.log("valeur est  " + value + "et le source est : " + source);
    argent[source] = value;
    console.log(argent);
}

// function envoi() {
//     console.log('post a la main');
//
//     $.post('http://lf2l/detailProjet', {'_token': ,'argent': 'plein'}), function () {
//         console.log("envoi");
//     }
//         .done(function () { // essayer de metre une pause
//             window.locatiwon.replace('http://lf2l/detailProjet');
//         });
// }


$('#formulaire').submit(function (event) {
    // Stop la propagation par défaut
    console.log("post a la main");
    // var total = "";
    // for (var indice in argent)
    //     total = total + indice+","+argent[indice]+";"
    // console.log(argent);


    event.preventDefault();
    // Récupération des valeurs qui sot pas dans le formulaire

    var $form = $(this),
        nom = $form.find("input[name='titre']").val(),
        token = $form.find("input[name='_token']").val(),
        date_pu = $form.find("input[name='date_pu']").val(),

        url = $form.attr("action");
    // Envoie des données
    $.post(url, {'_token': token, 'nom': nom, 'date_pu': date_pu, 'argent': 'super'})
        .done(function () {
            //window.location.replace('http://localhost/LF2L-interface/LF2L/public/personne/detailProjet')
            //voir si pas imcomplet l'URL
        });
});

