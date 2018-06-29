<title>W3.CSS</title>
<html >
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<body >
@include('header')
<input class="w3-input w3-border w3-padding" type="text" placeholder="Chercher une publication" id="myInput" onkeyup="recherche()" style="max-Width:70%;margin-left: 15%">

<div id="liste" style="padding-left: 5%">
<?php
    $pattern_date = "#[0-9]{4}#";
        foreach ($dates as $date){
            echo "<h3>".$date."</h3>";
            foreach ($publications as $publication){

                preg_match_all($pattern_date, $publication -> date_publication, $matches_date);

                if($date == $matches_date[0][0]){
                    echo "<div class='w3-panel  div'>";

                    foreach ($personnes as $personne){
                        $redige_articles = \App\redige_article::where('id_personne', $personne->id_personne) ->get();
                        foreach ($redige_articles as $redige_article){
                            if ($personne -> id_personne == $redige_article -> id_personne && $publication -> id_article == $redige_article -> id_article){
                                echo $personne -> Nom.' ';
                                echo $personne -> prenom .",";
                            }
                        }
                    }



                    echo "<a href='https://hal.archives-ouvertes.fr/".$publication ->identifiant ."'target='_blank' class='p'>".$publication -> titre_article."</a><br>";

                    echo "</div>";
                }
            }
        }

        ?>
</div>
@include('footer')
</body>
<script>
    function recherche() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("liste");
        tr = table.getElementsByClassName('div');
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName('p')[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</html>