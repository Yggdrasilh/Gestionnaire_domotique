<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Foyer;

class FoyerModel extends Dbconnect
{

    function findAll()
    {
        $this->request = "SELECT * FROM foyer";
        $result = $this->_connect->query($this->request);
        $liste = $result->fetchAll();

        return $liste;
    }

    function findOne($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM foyer LEFT JOIN module ON module.id_foyer = foyer.id WHERE foyer.id = ?");
        $request->execute(array($id));
        $liste = $request->fetch();

        return $liste;
    }

    function findRole($idUser, $idFoyer)
    {
        $request = $this->_connect->prepare("SELECT * FROM foyer LEFT JOIN avoir ON avoir.id_foyer = foyer.id WHERE foyer.id = ? AND avoir.id_utilisateur = ?");
        $request->execute(array($idFoyer, $idUser));
        $liste = $request->fetch();

        return $liste;
    }



    function create(Foyer $foyer, $id_utilisateur)
    {
        $request = $this->_connect->prepare("INSERT INTO `foyer`(`nom_foyer`, `photo_foyer`) VALUES (?,?); SET @last_id = LAST_INSERT_ID(); INSERT INTO  `avoir` (`id_foyer`, `id_utilisateur`, `role_utilisateur`) VALUES (@last_id,?, 'admin')");
        $request->execute(array($foyer->getNom_foyer(), $foyer->getPhoto_foyer(), $id_utilisateur));
    }

    function delete($id)
    {
        $request = $this->_connect->prepare("DELETE FROM `foyer` WHERE id = ?");
        $request->execute(array($id));
    }

    function update(Foyer $foyer)
    {
        $request = $this->_connect->prepare("UPDATE `foyer` SET `nom_foyer`=?,`photo_foyer`=? WHERE id = ?");
        $request->execute(array($foyer->getNom_foyer(), $foyer->getPhoto_foyer(), $foyer->getId()));
    }
}
