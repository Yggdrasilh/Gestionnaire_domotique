<?php

$title = 'GD - Tableau de bord';

if (!$moduleData) {
?>
    <div class="alert alert-warning" role="alert">
        <h3> Aucun foyer n'est sélectionner ! <br>
            Veuillez sélectionner ou créer un foyer.</h3>
    </div>
<?php
} elseif ($moduleData === 'noModule') {
?>
    <div class="alert alert-info" role="alert">
        <h3> Votre foyer ne comporte aucun module ! <br>
            Vous pouvez en créer avec le bouton "Ajouter un module" dans la sidebar. </h3>
    </div>
<?php
} else {

?>
    <div id="listeModulesTB">
        <?php
        // Création des modules en fonction de leur type 
        foreach ($moduleData['module'] as $value) {
        ?>
            <div class="card eltTablBord" id="<?= $value['id_module'] ?>">
                <img src="<?= $value['photo_module'] ?>" class="card-img-top" alt="<?= $value['nom_module'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $value['nom_module'] ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Type : <?= $value['type_module'] ?></li>
                    <li class="list-group-item">Position <span class="badge text-bg-secondary"><?= $value['position_module'] ?></span></li>
                    <?php
                    if ($value['type_module'] == 'timer') {
                    ?>
                        <li class="list-group-item">Timer : <?= $value['timer_module'] ?>s</li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="card-body actionTablBord">
                    <a class="btn btn-danger deleteModule" data-id="<?= $value['id_module'] ?>"><i class="bi bi-trash-fill"></i></a>
                    <a href="index.php?controller=Module&action=edit&id=<?= $value['id_module'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
