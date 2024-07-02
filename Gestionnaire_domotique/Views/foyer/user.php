<?php

$title = 'GD - User of Foyer';

if (!$myFoyerData) {
?>
    <div class="alert alert-warning" role="alert">
        <h3> Vous n'avez sélectionner aucun foyer pour l'instant !</h3>
    </div>
<?php
} else {
?>
    <div id="listeFoyers">
        <?php
        if ($authorisation == 'admin' || $authorisation == 'modo') {
        ?>
            <div id="addUserToFoyer">
                <a class="btn btn-primary btn-lg foyerAddUser" href="index.php?controller=Foyer&action=addUserToFoyer" role="button">Ajouter un utilisateur</a>
            </div>
        <?php
        }

        // Création des modules en fonction de leur type 
        foreach ($myFoyerData['avoir'] as $value) {
        ?>
            <div id="<?= $value['id_avoir'] ?>" class="card mb-3 userOfFoyer">
                <div class="card-body">
                    <h5 class="card-title"><?= $value['nom_utilisateur'] ?></h5>
                    <p class="card-text"><?= $value['email_utilisateur'] ?></p>
                    <p class="card-text role<?= $value['id_avoir'] ?>"><?= $value['role_utilisateur'] ?></p>
                    <?php
                    if ($authorisation == 'admin' && $value['role_utilisateur'] != 'admin') {
                    ?>
                        <div class="actionAdminFoyer">
                            <button type="button" class="btn btn-danger suppUserOfFoyer" data-id="<?= $value['id_avoir'] ?>" data-idUser="<?= $value['id_utilisateur'] ?>">Remove</button>
                            <button type="button" class="btn btn-primary editUserOfFoyer euof<?= $value['id_avoir'] ?>" data-id="<?= $value['id_avoir'] ?>" data-idUser="<?= $value['id_utilisateur'] ?>" data-role="<?= $value['role_utilisateur'] ?>" data-name="<?= $value['nom_utilisateur'] ?>">Role</button>
                        </div>
                    <?php
                    } elseif ($authorisation == 'modo' && $value['role_utilisateur'] != 'admin') {
                    ?>
                        <div class="actionAdminFoyer">
                            <button type="button" class="btn btn-danger suppUserOfFoyer" data-id="<?= $value['id_avoir'] ?>" data-idUser="<?= $value['id_utilisateur'] ?>">Remove</button>
                            <button type="button" class="btn btn-primary editUserOfFoyer euof<?= $value['id_avoir'] ?>" data-id="<?= $value['id_avoir'] ?>" data-idUser="<?= $value['id_utilisateur'] ?>" data-role="<?= $value['role_utilisateur'] ?>" data-name="<?= $value['nom_utilisateur'] ?>">Role</button>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <div id="emplacementForm">
        </div>
    <?php
}
