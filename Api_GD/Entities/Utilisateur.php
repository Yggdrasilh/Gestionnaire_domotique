<?php

namespace App\Entities;

class Utilisateur
{

    private $id;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $mdp_utilisateur;
    private $photo_utilisateur;
    private $status_utilisateur;

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
     * Get the value of nom_utilisateur
     */
    public function getNom_utilisateur()
    {
        return $this->nom_utilisateur;
    }

    /**
     * Set the value of nom_utilisateur
     *
     * @return  self
     */
    public function setNom_utilisateur($nom_utilisateur)
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    /**
     * Get the value of email_utilisateur
     */
    public function getEmail_utilisateur()
    {
        return $this->email_utilisateur;
    }

    /**
     * Set the value of email_utilisateur
     *
     * @return  self
     */
    public function setEmail_utilisateur($email_utilisateur)
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    /**
     * Get the value of mdp_utilisateur
     */
    public function getMdp_utilisateur()
    {
        return $this->mdp_utilisateur;
    }

    /**
     * Set the value of mdp_utilisateur
     *
     * @return  self
     */
    public function setMdp_utilisateur($mdp_utilisateur)
    {
        $this->mdp_utilisateur = $mdp_utilisateur;

        return $this;
    }

    /**
     * Get the value of photo_utilisateur
     */
    public function getPhoto_utilisateur()
    {
        return $this->photo_utilisateur;
    }

    /**
     * Set the value of photo_utilisateur
     *
     * @return  self
     */
    public function setPhoto_utilisateur($photo_utilisateur)
    {
        $this->photo_utilisateur = $photo_utilisateur;

        return $this;
    }

    /**
     * Get the value of status_utilisateur
     */
    public function getStatus_utilisateur()
    {
        return $this->status_utilisateur;
    }

    /**
     * Set the value of status_utilisateur
     *
     * @return  self
     */
    public function setStatus_utilisateur($status_utilisateur)
    {
        $this->status_utilisateur = $status_utilisateur;

        return $this;
    }
}
