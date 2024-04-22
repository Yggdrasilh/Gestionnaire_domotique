<?php

$title = 'GD - Création Foyer';
echo $messageError;


?>
<form action="index.php?controller=Foyer&action=creation" method="post" id="foyerCreationForm" enctype='multipart/form-data'>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nom du Foyer</span>
        <input type="text" class="form-control" placeholder="Nom du Foyer" aria-label="Username" aria-describedby="basic-addon1" name='nom_foyer'>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="imageFoyerSelecte">Image du foyer</label>
        <select class="form-select" id="imageFoyerSelecte" name="photo_foyer">
            <option selected value="image/maison.webp">Maison</option>
            <option value="image/maison_villa.webp">Villa</option>
            <option value="image/maison_immeuble.webp">Immeuble</option>
            <option value="image/maison_grande.webp">Grande maison</option>
            <option value="image/maison_chateau.webp">Château</option>
            <option value="image/maison_chalet.webp">Chalet</option>
            <option value="image/maison_bourgeoise.webp">Maison bourgeoise</option>
        </select>
    </div>

    <!-- <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">Choisir une image</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="image">
    </div> -->

    <input class="btn btn-primary" type="submit" value="Create">
</form>