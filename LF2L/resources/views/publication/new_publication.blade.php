<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<div class="w3-container">
    <h2>Ajout d'une nouvelle publication</h2>
    <p>type de publication:  </p>


    <div class="w3-dropdown-click">
        <button class="w3-button" onclick="myFunction()">
            Type de publication <i class="fa fa-caret-down"></i>
        </button>
        <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">
            <a href="these" class="w3-bar-item w3-button">These</a>
            <a href="#" class="w3-bar-item w3-button">Link 2</a>
            <a href="#" class="w3-bar-item w3-button">Link 3</a>
        </div>
    </div>

</div>

<script>
    function myFunction() {
        var x = document.getElementById("demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

</body>
</html>
