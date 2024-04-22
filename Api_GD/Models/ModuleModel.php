<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Module;

class ModuleModel extends Dbconnect
{

    // function findAll()
    // {
    //     $this->request = "SELECT * FROM module";
    //     $result = $this->_connect->query($this->request);
    //     $liste = $result->fetchAll();

    //     return $liste;
    // }

    // Spécifique au SELECT pour les modules

    function findAllByFoyer($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM module WHERE id_foyer = ?");
        $request->execute(array($id));
        $liste = $request->fetchAll();

        return $liste;
    }

    function findHighestPosition($id)
    {
        $request = $this->_connect->prepare("SELECT position_module FROM `module` WHERE position_module = (SELECT MAX(position_module) FROM `module` WHERE id_foyer = ?)");
        $request->execute(array($id));
        $liste = $request->fetch();

        return $liste;
    }

    // fin de truc spécifique

    function findOne($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM module WHERE id_module = ?");
        $request->execute(array($id));
        $liste = $request->fetch();

        return $liste;
    }


    function create(Module $module)
    {
        $request = $this->_connect->prepare("INSERT INTO  `module`(`nom_module`, `type_module`, `photo_module`, `position_module`, `url_open_module`, `url_var_module`, `url_close_module`, `timer_module`, `id_foyer`) VALUES (?,?,?,?,?,?,?,?,?)");
        $request->execute(array($module->getNom_module(), $module->getType_module(), $module->getPhoto_module(), $module->getPosition_module(), $module->getUrl_open_module(), $module->getUrl_var_module(), $module->getUrl_close_module(), $module->getTimer_module(), $module->getId_foyer()));
    }

    function delete($id)
    {
        $request = $this->_connect->prepare("DELETE FROM module WHERE id_module = ?");
        $request->execute(array($id));
    }

    function update(Module $module, $id)
    {
        $request = $this->_connect->prepare("UPDATE `module` SET `nom_module`= ?,`type_module`= ?,`photo_module`= ?,`position_module`= ?,`url_open_module`= ?,`url_var_module`= ?,`url_close_module`= ?,`timer_module`= ? WHERE id_module =  ?");
        $request->execute(array($module->getNom_module(), $module->getType_module(), $module->getPhoto_module(), $module->getPosition_module(), $module->getUrl_open_module(), $module->getUrl_var_module(), $module->getUrl_close_module(), $module->getTimer_module(), $id));
    }

    function updatePosition(Module $module)
    {
        $request = $this->_connect->prepare("UPDATE `module` SET `position_module`= ? WHERE id_module =  ?");
        $request->execute(array($module->getPosition_module(), $module->getId()));
    }
}
