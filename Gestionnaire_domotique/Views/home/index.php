<?php

$title = 'GD - Home';

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
    <div id="listeModulesAccueil">
        <?php
        // Création des modules en fonction de leur type 
        foreach ($moduleData['module'] as $value) {

            switch ($value['type_module']) {
                case 'toggle':
        ?>
                    <div class="card text-bg-dark toggleModule" id="<?= $value['id_module'] ?>" data-urlopen="<?= $value['url_open_module'] ?>" data-urlclose="<?= $value['url_close_module'] ?>">
                        <a id="link<?= $value['id_module'] ?>" href="<?= $value['url_open_module'] ?>" target="_blank" style="color: var(--bs-card-title-color);">
                            <img src="<?= $value['photo_module'] ?>" class="card-img" alt="<?= $value['nom_module'] ?>">
                            <div class="card-img-overlay">
                                <h5 class="card-title"><?= $value['nom_module']; ?></h5>
                            </div>
                        </a>
                    </div>

                <?php
                    break;

                case 'timer':
                ?>
                    <div class="card text-bg-dark timerModule" id="<?= $value['id_module'] ?>" data-urlopen="<?= $value['url_open_module'] ?>" data-timer="<?= $value['timer_module'] ?>" data-urlclose="<?= $value['url_close_module'] ?>">
                        <img src="<?= $value['photo_module'] ?>" class="card-img" alt="<?= $value['nom_module'] ?>">
                        <div class="card-img-overlay">
                            <h5 class="card-title"><?= $value['nom_module']; ?></h5>
                        </div>
                    </div>
                <?php
                    break;

                case 'push':
                ?>
                    <div class="card text-bg-dark pushModule" id="<?= $value['id_module'] ?>" data-urlopen="<?= $value['url_open_module'] ?>" data-urlclose="<?= $value['url_close_module'] ?>">
                        <img src="<?= $value['photo_module'] ?>" class="card-img" alt="<?= $value['nom_module'] ?>">
                        <div class="card-img-overlay">
                            <h5 class="card-title"><?= $value['nom_module']; ?></h5>
                        </div>
                    </div>
                <?php
                    break;

                case 'range':
                ?>
                    <div class="card text-bg-dark rangeModule" id="<?= $value['id_module'] ?>" data-urlopen="<?= $value['url_open_module'] ?>" data-urlclose="<?= $value['url_close_module'] ?>">
                        <img src="<?= $value['photo_module'] ?>" class="card-img" alt="<?= $value['nom_module'] ?>">
                        <div class="card-img-overlay">
                            <h5 class="card-title"><?= $value['nom_module']; ?></h5>
                        </div>
                    </div>
                <?php
                    break;

                case 'switch':
                ?>
                    <div class="card text-bg-dark switchModule" id="<?= $value['id_module'] ?>" data-urlopen="<?= $value['url_open_module'] ?>" data-urlclose="<?= $value['url_close_module'] ?>">
                        <img src="<?= $value['photo_module'] ?>" class="card-img" alt="<?= $value['nom_module'] ?>">
                        <div class="card-img-overlay">
                            <h5 class="card-title"><?= $value['nom_module']; ?></h5>
                        </div>
                    </div>
        <?php
                    break;

                default:
                    # code...
                    break;
            }
        }
        ?>
    </div>
<?php
}
