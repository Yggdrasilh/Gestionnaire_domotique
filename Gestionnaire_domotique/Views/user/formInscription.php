<?php
// var_dump($_SESSION);

$title = "GD - Inscription";
echo $messageError;
$userAllData = json_encode($userAllData);
?>
<!-- Penser a envoyer ses requetes POST vers son propre controlleur.  -->

<div id='formaddBlock'>
    <h1>Je m'inscris </h1>

    <form id="envoyer" class="formadd" method="post" action="index.php?controller=user&action=inscription" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom : </label>
            <input name="nom_user" type="text" class="form-control" id="nom" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email : </label>
            <input name="email_user" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe : </label>
            <input name="password_user" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Photo de profil : </label>
            <input name="photo_user" type="file" class="form-control" id="prenom">
        </div>
        <button type="submit" class="btn btn-primary" name="valider">Valider</button>
    </form>
</div>

<script>
    var allNameUser = JSON.parse('<?php echo $userAllData; ?>');
</script>