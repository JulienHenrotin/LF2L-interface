<!DOCTYPE HTML>
<html>
<header>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</header>

<div class="w3-col" style="width:20%"><p></p></div>
<div class="w3-col" style="width:60%">
    <div class="w3-container">
        <h2>Connexion</h2>
    </div>
    <form method="post" id="formulaire" >
    {{ csrf_field() }} <!-- token de sécurité imposé par laravel pour les formulaires-->
        <p>Votre email </p>
        <input class="w3-input w3-border w3-round-xxlarge" name="mail">

        <p>Votre mot de passe </p>
        <input class="w3-input w3-border w3-round-xxlarge"  name="password" type="password">
        <input type="submit" class="w3-button w3-btn w3-round-xxlarge w3-margin w3-green w3-hover-purple">

    </form>
</div>
</html>