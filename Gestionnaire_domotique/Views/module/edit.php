<?php

$title = 'GD - Edit module';
if (!$messageError) {
?>
    <div class="alert alert-warning" role="alert">
        <h3> Une erreur est survenue veuillez recommencer !</h3>
    </div>
<?php
} else {
    $tablType = ['toggle', 'timer', 'push', 'range', 'switch'];
?>
    <h4>Selectionnez un type de module :</h4>
    <form action="index.php?controller=Module&action=edit&id=<?= $moduleData['id_module'] ?>" method="post" id="ajoutModuleForm" enctype='multipart/form-data'>

        <div class="input-group mb-3">
            <label class="input-group-text" for="selectTypeModule">Type de module</label>
            <select class="form-select" id="selectTypeEdit_module" name="type_module" data-type="<?= $moduleData['type_module'] ?>">
                <option value="toggle">toggle</option>
                <option value="timer">timer</option>
                <option value="push">push</option>
                <option value="range" disabled>range</option>
                <option value="switch" disabled>switch</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom module</span>
            <input type="text" class="form-control" value="<?= $moduleData['nom_module'] ?>" aria-label="Username" aria-describedby="basic-addon1" name="nom_module">
        </div>

        <div class="input-group mb-3">
            <select class="form-select" id="editSelectPhotoModule" name="photo_module" data-photo="<?= $moduleData['photo_module'] ?>">
                <option value="image/module_default.webp">Image par defaut</option>
                <option value="image/module_lumiere.webp">Lumière</option>
                <option value="image/module_portaille.webp">Portaille</option>
                <option value="image/module_porte-garage.webp">Garage</option>
            </select>
            <label class="input-group-text" for="selectPhotoModule">Image du module</label>
        </div>

        <div class="input-group mb-3">
            <input type="number" value="<?= $moduleData['position_module'] ?>" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="position_module">
            <span class="input-group-text" id="basic-addon2">Position module</span>
        </div>

        <div class="mb-3">
            <label for="inputeUrlOpen" class="form-label">L'url d'activation</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                <input type="text" class="form-control" value="<?= $moduleData['url_open_module'] ?>" id="inputeUrlOpen" aria-describedby="basic-addon3 basic-addon4" name="url_open_module">
            </div>
        </div>

        <div class="mb-3" id="varInputeEditModule" hidden>
            <label for="inputeUrlVar" class="form-label">L'url de variation de votre module</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                <input type="text" class="form-control" value="<?= $moduleData['url_var_module'] ?>" id="inputeUrlVar" aria-describedby="basic-addon3 basic-addon4" name="url_var_module">
            </div>
        </div>


        <div class="mb-3">
            <label for="inputeUrlClose" class="form-label">L'url de désactivation</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">https://example.com/02.03.05/</span>
                <input type="text" class="form-control" value="<?= $moduleData['url_close_module'] ?>" id="inputeUrlClose" aria-describedby="basic-addon3 basic-addon4" name="url_close_module">
            </div>
        </div>

        <div class="input-group mb-3" id="timerInputeEditModule" hidden>
            <input type="number" value="<?= $moduleData['timer_module'] ?>" class="form-control" aria-describedby="basic-addon2" name="timer_module">
            <span class="input-group-text" id="basic-addon2">Timer du module (en seconde)</span>
        </div>


        <input class="btn btn-primary" type="submit" value="Save">
    </form>

<?php
}
