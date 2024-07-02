<?php $title = "Mes informations personnels" ?>

<div class="card profilcard" style="width: 20rem;">
    <img src="<?php echo $_SESSION['photo_utilisateur'] ?>" class="card-img-top" alt="<?php echo $_SESSION['nom_utilisateur'] ?>">
    <div class="card-body">
        <h4 class="card-title nameprofil"><b> Nom :</b> <?php echo $_SESSION['nom_utilisateur'] ?></h4>
        <h4 class="card-title nameprofil"><b>Email :</b> <?php echo $_SESSION['email_utilisateur'] ?></h4>
        <h4 class="card-title nameprofil"><b>Mot de passe : </b>******** </h4>
        <a href="index.php?controller=user&action=updateProfil">
            <p class="card-text">Modifier mes informations personnels? </p>
        </a>
        <a href="index.php?controller=user&action=updateMdpProfil">
            <p class="card-text">Changer de mot de passe? </p>
        </a>
    </div>
</div>