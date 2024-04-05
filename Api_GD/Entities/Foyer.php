<?php

namespace App\Entities;

class Foyer
{

    private $id;
    private $nom_foyer;
    private $photo_foyer;

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
     * Get the value of nom_foyer
     */
    public function getNom_foyer()
    {
        return $this->nom_foyer;
    }

    /**
     * Set the value of nom_foyer
     *
     * @return  self
     */
    public function setNom_foyer($nom_foyer)
    {
        $this->nom_foyer = $nom_foyer;

        return $this;
    }

    /**
     * Get the value of photo_foyer
     */
    public function getPhoto_foyer()
    {
        return $this->photo_foyer;
    }

    /**
     * Set the value of photo_foyer
     *
     * @return  self
     */
    public function setPhoto_foyer($photo_foyer)
    {
        $this->photo_foyer = $photo_foyer;

        return $this;
    }
}
