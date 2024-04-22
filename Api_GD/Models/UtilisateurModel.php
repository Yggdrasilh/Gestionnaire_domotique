<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Utilisateur;

class UtilisateurModel extends Dbconnect
{

    function findAll()
    {
        $this->request = "SELECT `id`, `nom_utilisateur`, `email_utilisateur`, `photo_utilisateur`, `status_utilisateur` FROM utilisateur";
        $result = $this->_connect->query($this->request);
        $liste = $result->fetchAll();

        return $liste;
    }

    function findOne($id)
    {
        $request = $this->_connect->prepare("SELECT * FROM utilisateur Where id = ?");
        $request->execute(array($id));
        $liste = $request->fetch();

        return $liste;
    }

    // Authentification 

    function  connexion($login)
    {
        $request = $this->_connect->prepare("SELECT * FROM utilisateur Where nom_utilisateur  = ?");
        $request->execute(array($login));
        $liste = $request->fetch();

        return $liste;
    }

    // Fin authentification



    function create(Utilisateur $user)
    {
        $request = $this->_connect->prepare("INSERT INTO `utilisateur`(`nom_utilisateur`, `email_utilisateur`, `mdp_utilisateur`, `photo_utilisateur`) VALUES (?,?,?,?)");
        $request->execute(array($user->getNom_utilisateur(), $user->getEmail_utilisateur(), $user->getMdp_utilisateur(), $user->getPhoto_utilisateur()));
    }

    function delete($id)
    {
        $request = $this->_connect->prepare("DELETE FROM `utilisateur` WHERE id = ?");
        $request->execute(array($id));
    }

    function update(Utilisateur $user, $id)
    {
        $request = $this->_connect->prepare("UPDATE `utilisateur` SET `nom_utilisateur`=?,`email_utilisateur`=?,`photo_utilisateur`=? WHERE id = ?");
        $request->execute(array($user->getNom_utilisateur(), $user->getEmail_utilisateur(), $user->getPhoto_utilisateur(), $id));
    }

    function updateMdp(Utilisateur $user, $id)
    {
        $request = $this->_connect->prepare("UPDATE `utilisateur` SET `mdp_utilisateur`=? WHERE id = ?");
        $request->execute(array($user->getMdp_utilisateur(), $id));
    }
}
