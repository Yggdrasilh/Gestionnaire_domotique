<?php

$title = 'GD - Ajout module';
if (!$messageError) {
?>
    <div class="alert alert-warning" role="alert">
        <h3> Aucun foyer n'est sélectionner !</h3>
    </div>
<?php
} else {
    $lastPosition = ($positionData['module']['position_module'] ? $positionData['module']['position_module'] + 1 : 1);

?>
    <h4>Choisissez un type de module :</h4>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-toggle-tab" data-bs-toggle="tab" data-bs-target="#nav-toggle" type="button" role="tab" aria-controls="nav-toggle" aria-selected="true">Toggle</button>
            <button class="nav-link" id="nav-timer-tab" data-bs-toggle="tab" data-bs-target="#nav-timer" type="button" role="tab" aria-controls="nav-timer" aria-selected="false">Timer</button>
            <button class="nav-link" id="nav-push-tab" data-bs-toggle="tab" data-bs-target="#nav-push" type="button" role="tab" aria-controls="nav-push" aria-selected="false">Push</button>
            <button class="nav-link" id="nav-range-tab" data-bs-toggle="tab" data-bs-target="#nav-range" type="button" role="tab" aria-controls="nav-range" aria-selected="false" disabled>Range</button>
            <button class="nav-link" id="nav-switch-tab" data-bs-toggle="tab" data-bs-target="#nav-range" type="button" role="tab" aria-controls="nav-switch" aria-selected="false" disabled>Switch</button>
        </div>
    </nav>
    <form action="index.php?controller=Module&action=add" method="post" id="ajoutModuleForm" enctype='multipart/form-data'>
        <div class="tab-content" id="nav-tabContent">
            <!-- <div class="tab-pane fade show active" id="nav-toggle" role="tabpanel" aria-labelledby="nav-toggle-tab" tabindex="0">...</div> -->
            <!-- <div class="tab-pane fade" id="nav-push" role="tabpanel" aria-labelledby="nav-push-tab" tabindex="0">...</div> -->

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nom module</span>
                <input type="text" class="form-control" placeholder="Nom du module" aria-label="Username" aria-describedby="basic-addon1" name="nom_module">
            </div>

            <div class="input-group mb-3" hidden>
                <label class="input-group-text" for="selectTypeModule">Type de module</label>
                <select class="form-select" id="selectType_module" name="type_module">
                    <option id="typeSelected" value="toggle" selected>toggle</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <select class="form-select" id="selectPhotoModule" name="photo_module">
                    <option value="image/module_default.webp" selected>Image par defaut</option>
                    <option value="image/module_lumiere.webp">Lumière</option>
                    <option value="image/module_portaille.webp">Portail</option>
                    <option value="image/module_porte-garage.webp">Garage</option>
                </select>
                <label class="input-group-text" for="selectPhotoModule">Image du module</label>
            </div>

            <div class="input-group mb-3">
                <input type="number" value="<?= $lastPosition ?>" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="position_module">
                <span class="input-group-text" id="basic-addon2">Position module</span>
            </div>

            <div class="mb-3">
                <label for="inputeUrlOpen" class="form-label">L'url d'activation</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                    <input type="text" class="form-control" value="http://" id="inputeUrlOpen" aria-describedby="basic-addon3 basic-addon4" name="url_open_module">
                </div>
            </div>

            <div class="tab-pane fade" id="nav-range" role="tabpanel" aria-labelledby="nav-range-tab" tabindex="0">
                <div class="mb-3">
                    <label for="inputeUrlVar" class="form-label">L'url de variation de votre module</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                        <input type="text" class="form-control" value="http://" id="inputeUrlVar" aria-describedby="basic-addon3 basic-addon4" name="url_var_module">
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="inputeUrlClose" class="form-label">L'url de désactivation</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                    <input type="text" class="form-control" value="http://" id="inputeUrlClose" aria-describedby="basic-addon3 basic-addon4" name="url_close_module">
                </div>
            </div>

            <div class="tab-pane fade" id="nav-timer" role="tabpanel" aria-labelledby="nav-timer-tab" tabindex="0">
                <div class="input-group mb-3">
                    <input type="number" value="1" class="form-control" aria-describedby="basic-addon2" name="timer_module">
                    <span class="input-group-text" id="basic-addon2">Timer du module (en seconde)</span>
                </div>
            </div>


            <input class="btn btn-primary" type="submit" value="Ajouter">
        </div>
    </form>

<?php
}
