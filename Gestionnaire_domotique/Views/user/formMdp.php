<?php
echo $messageError;
$title = "GD - Changer de mot de passe";
?>
<h1>Changer mon Mot de passe</h1>
<!-- Penser a envoyer ses requetes POST vers son propre controlleur.  -->

<form class="formadd" id="envoyer" action="index.php?controller=user&action=updateMdpProfil" method="post">
    <div class="mb-3">
        <label class="form-label" for="id">Nouveau mot de passe : </label>
        <input class="form-control" type="password" name="new_password_user">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password"> Valider le Nouveau Mot de passe : </label>
        <input class="form-control" type="password" name="confim_new_password_user">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password"> Indiquer votre ancien Mot de passe : </label>
        <input class="form-control" type="password" name="password_user">
    </div>
    <button class="btn btn-primary" type="submit">Valider</button>

</form>