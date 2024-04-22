<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Avoir;

class AvoirModel extends Dbconnect
{

    function findAll()
    {
        $this->request = "SELECT * FROM avoir";
        $result = $this->_connect->query($this->request);
        $liste = $result->fetchAll();

        return $liste;
    }

    function findAllByUser($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM avoir INNER JOIN foyer ON foyer.id = avoir.id_foyer WHERE avoir.id_utilisateur = ?");
        $request->execute(array($id));
        $liste = $request->fetchAll();

        return $liste;
    }

    function findAllByFoyer($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM avoir INNER JOIN utilisateur ON utilisateur.id = avoir.id_utilisateur WHERE avoir.id_foyer = ?");
        $request->execute(array($id));
        $liste = $request->fetchAll();

        return $liste;
    }



    function create(Avoir $avoir)
    {
        $request = $this->_connect->prepare("INSERT INTO  `avoir` (`id_foyer`, `id_utilisateur`) VALUES (?,?)");
        $request->execute(array($avoir->getId_foyer(), $avoir->getId_utilisateur()));
    }

    function delete($id_utilisateur, $id_foyer)
    {
        $request = $this->_connect->prepare("DELETE FROM `avoir` WHERE id_utilisateur = ? AND id_foyer = ?");
        $request->execute(array($id_utilisateur, $id_foyer));
    }

    function update(Avoir $avoir)
    {
        $request = $this->_connect->prepare("UPDATE `avoir` SET `role_utilisateur`= ? WHERE id_utilisateur = ? AND id_foyer = ?");
        $request->execute(array($avoir->getRole_utilisateur(), $avoir->getId_utilisateur(), $avoir->getId_foyer()));
    }
}
