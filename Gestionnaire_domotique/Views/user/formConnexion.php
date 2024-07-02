<?php
// var_dump($_SESSION);

$title = "GD - Se Connecter";
echo $messageError;
?>
<div id="formLogBlock">
    <h1>Je me connecte</h1>
    <!-- Penser a envoyer ses requetes POST vers son propre controlleur.  -->

    <form class="formLog" id="envoyer" action="index.php?controller=user&action=login" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Identifiant : </label>
            <input name="nom_user" type="text" class="form-control" id="nom">
        </div>
        <div class="mb-3">
            <label class="form-label" for="mdp_form">Mot de passe : </label>
            <input class="form-control" id="mdp_form" type="password" name="password_user">
        </div>
        <button class="btn btn-primary" type="submit">Valider</button>

    </form>
    <p>Vous n'avez pas de compte ? Pour vous inscrire cliquer <a href="index.php?controller=User&action=inscription">ICI</a></p>
</div>