<?php

namespace App\Entities;

class Avoir
{

    private $id;
    private $id_foyer;
    private $id_utilisateur;
    private $role_utilisateur;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_foyer
     */
    public function getId_foyer()
    {
        return $this->id_foyer;
    }

    /**
     * Set the value of id_foyer
     *
     * @return  self
     */
    public function setId_foyer($id_foyer)
    {
        $this->id_foyer = $id_foyer;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of role_utilisateur
     */
    public function getRole_utilisateur()
    {
        return $this->role_utilisateur;
    }

    /**
     * Set the value of role_utilisateur
     *
     * @return  self
     */
    public function setRole_utilisateur($role_utilisateur)
    {
        $this->role_utilisateur = $role_utilisateur;

        return $this;
    }
}
