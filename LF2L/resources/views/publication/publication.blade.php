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
        foreach ($publications as $publication){
            echo "<div class='w3-panel w3-border-bottom w3-border-purple div'>";
            echo "<a href='https://hal.archives-ouvertes.fr/".$publication ->identifiant ."'target='_blank' class='p'>".$publication -> titre_article."</a><br>";
            //echo $publication -> domaine_article."<br>";
            echo $publication -> date_publication."<br>";
            echo $publication -> langue_article."<br>";
            foreach ($prepublications as $prepublication){
                if($prepublication -> id_article == $publication -> id_article){
                    echo "Prepublication<br>";
                }
            }

            foreach ($rapports as $rapport){
                if($rapport -> id_article == $publication -> id_article){
                    echo "Rapport<br>";
                }
            }

            foreach ($articles_publication_presse as $article_publication_presse){
                if($article_publication_presse -> id_article == $publication -> id_article){
                    echo "Article/Publication dans la presse<br>";
                }
            }

            foreach ($liste_hdr as $hdr){
                if($hdr -> id_article == $publication -> id_article){
                    echo "HDR<br>";
                }
            }

            foreach ($theses as $these){
                if($these -> id_article == $publication -> id_article){
                    echo "These<br>";
                }
            }

            foreach ($publications_conference as $publication_conference){
                if($publication_conference -> id_article == $publication -> id_article){
                    echo "Publication/Poster dans une conference<br>";
                }
            }
            echo "<br>";
            echo "</div>";
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