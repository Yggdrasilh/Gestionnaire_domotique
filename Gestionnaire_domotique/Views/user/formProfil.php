<?php
echo $messageError;
$title = 'Modifier mes informations.';
?>

<form class="formadd" id="envoyer" action="index.php?controller=user&action=updateProfil" method="post">
    <div class="mb-3">
        <label class="form-label" for="id">Nom </label>
        <input class="form-control" value="<?php echo $_SESSION['nom_utilisateur'];  ?>  " ? id="nom_user" type="text" name="nom_user">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password"> Email </label>
        <input class="form-control" value="<?php echo $_SESSION['email_utilisateur'];  ?>  " id="email" type="email" name="email_user">
    </div>
    <button class="btn btn-primary" name="update" type="submit">Mettre a jour</button>