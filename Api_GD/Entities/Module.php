<?php

namespace App\Entities;

class Module
{

    private $id;
    private $nom_module;
    private $type_module;
    private $photo_module;
    private $position_module;
    private $url_open_module;
    private $url_var_module;
    private $url_close_module;
    private $timer_module;
    private $id_foyer;

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
     * Get the value of nom_module
     */
    public function getNom_module()
    {
        return $this->nom_module;
    }

    /**
     * Set the value of nom_module
     *
     * @return  self
     */
    public function setNom_module($nom_module)
    {
        $this->nom_module = $nom_module;

        return $this;
    }

    /**
     * Get the value of type_module
     */
    public function getType_module()
    {
        return $this->type_module;
    }

    /**
     * Set the value of type_module
     *
     * @return  self
     */
    public function setType_module($type_module)
    {
        $this->type_module = $type_module;

        return $this;
    }

    /**
     * Get the value of photo_module
     */
    public function getPhoto_module()
    {
        return $this->photo_module;
    }

    /**
     * Set the value of photo_module
     *
     * @return  self
     */
    public function setPhoto_module($photo_module)
    {
        $this->photo_module = $photo_module;

        return $this;
    }

    /**
     * Get the value of position_module
     */
    public function getPosition_module()
    {
        return $this->position_module;
    }

    /**
     * Set the value of position_module
     *
     * @return  self
     */
    public function setPosition_module($position_module)
    {
        $this->position_module = $position_module;

        return $this;
    }

    /**
     * Get the value of url_open_module
     */
    public function getUrl_open_module()
    {
        return $this->url_open_module;
    }

    /**
     * Set the value of url_open_module
     *
     * @return  self
     */
    public function setUrl_open_module($url_open_module)
    {
        $this->url_open_module = $url_open_module;

        return $this;
    }

    /**
     * Get the value of url_var_module
     */
    public function getUrl_var_module()
    {
        return $this->url_var_module;
    }

    /**
     * Set the value of url_var_module
     *
     * @return  self
     */
    public function setUrl_var_module($url_var_module)
    {
        $this->url_var_module = $url_var_module;

        return $this;
    }

    /**
     * Get the value of url_close_module
     */
    public function getUrl_close_module()
    {
        return $this->url_close_module;
    }

    /**
     * Set the value of url_close_module
     *
     * @return  self
     */
    public function setUrl_close_module($url_close_module)
    {
        $this->url_close_module = $url_close_module;

        return $this;
    }

    /**
     * Get the value of timer_module
     */
    public function getTimer_module()
    {
        return $this->timer_module;
    }

    /**
     * Set the value of timer_module
     *
     * @return  self
     */
    public function setTimer_module($timer_module)
    {
        $this->timer_module = $timer_module;

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
}
