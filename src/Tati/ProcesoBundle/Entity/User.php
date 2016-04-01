<?php
// src/AppBundle/Entity/User.php

namespace Tati\ProcesoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Actividad", mappedBy="user")
     */
    private $actividad;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Set actividad
     *
     * @param \Tati\ProcesoBundle\Entity\Actividad $actividad
     * @return User
     */
    public function setActividad(\Tati\ProcesoBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \Tati\ProcesoBundle\Entity\Actividad 
     */
    public function getActividad()
    {
        return $this->actividad;
    }
}
