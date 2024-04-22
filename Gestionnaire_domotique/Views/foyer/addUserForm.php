<?php

$title = 'GD - Add User';
echo $messageError;


?>
<form action="index.php?controller=Foyer&action=addUserToFoyer" method="post" id="foyerAddUserForm" enctype='multipart/form-data'>

    <label for="userAddSearch" class="form-label">Search User to add</label>
    <input class="form-control" list="datalistOptions" id="userAddSearch" placeholder="Search User..." name="nom_user">
    <datalist id="datalistOptions">
        <?php
        foreach ($userAllData['user'] as $value) {
        ?>
            <option value="<?= $value['nom_utilisateur'] ?>"></option>

        <?php
        }
        ?>
    </datalist>


    <input class="btn btn-primary" type="submit" value="Add">
</form>