<?php

$title = 'GD - Home';
$sessFoyer = $_SESSION['id_foyer'] ?? '';
if (!$myFoyerData) {
?>
    <div class="alert alert-warning" role="alert">
        <h3> Vous n'avez créé ou été invité dans aucun foyer pour l'instant !</h3>
    </div>
<?php
} else {
?>
    <div id="listeFoyers">
        <?php
        // Création des modules en fonction de leur type 
        foreach ($myFoyerData['avoir'] as $value) {
            $borderThisFoyer = $value['id_foyer'] == $sessFoyer ? " selected" : ''
        ?>
            <div id="<?= $value['id_foyer'] ?>" class="card mesFoyers<?= $borderThisFoyer ?>">
                <img src="<?= $value['photo_foyer'] ?>" class="card-img-top imgFoyers img<?= $value['id_foyer'] ?>" alt="<?= $value['nom_foyer'] ?>">
                <div class="card-body">
                    <h5 class="card-text title<?= $value['id_foyer'] ?>"><?= $value['nom_foyer'] ?></h5>
                    <?php
                    if ($value['role_utilisateur'] == 'admin') {
                    ?>
                        <div class="actionAdminFoyer">
                            <button type="button" class="btn btn-outline-primary editFoyer ef<?= $value['id_foyer'] ?>" data-id="<?= $value['id_foyer'] ?>" data-image="<?= $value['photo_foyer'] ?>" data-nom="<?= $value['nom_foyer'] ?>">Update</button>
                            <button type="button" class="btn btn-outline-danger suppFoyer" data-id="<?= $value['id_foyer'] ?>">Delete</button>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php

        }
        ?>
    </div>
    <div id="emplacementForm">

    </div>
<?php
}
