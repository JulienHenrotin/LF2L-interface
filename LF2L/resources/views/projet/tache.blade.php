
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-row-padding">
<div class="w3-half">

    <form  method="post">
        {{ csrf_field() }}

            <p><input class="w3-input w3-border w3-round-large" type="text" name="nom"></p>
            <p><textarea class="w3-input w3-border w3-round"  name="desc" ></textarea></p>
            <p><input type="submit" value="envoyer" ></p>
    </form>
</div>
</div>