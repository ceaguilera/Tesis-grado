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
     * @ORM\OneToOne(targetEntity="PerfilSolicitante", mappedBy="user")
     */
    private $perfilSolicitante;

    /**
     * @ORM\OneToOne(targetEntity="PerfilResponsable", mappedBy="user")
     */
    private $perfilResponsable;



    /**
     * Set perfilSolicitante
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilSolicitante $perfilSolicitante
     * @return User
     */
    public function setPerfilSolicitante(\Tati\ProcesoBundle\Entity\PerfilSolicitante $perfilSolicitante = null)
    {
        $this->perfilSolicitante = $perfilSolicitante;

        return $this;
    }

    /**
     * Get perfilSolicitante
     *
     * @return \Tati\ProcesoBundle\Entity\PerfilSolicitante 
     */
    public function getPerfilSolicitante()
    {
        return $this->perfilSolicitante;
    }

    /**
     * Set perfilResponsable
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilResponsable $perfilResponsable
     * @return User
     */
    public function setPerfilResponsable(\Tati\ProcesoBundle\Entity\PerfilResponsable $perfilResponsable = null)
    {
        $this->perfilResponsable = $perfilResponsable;

        return $this;
    }

    /**
     * Get perfilResponsable
     *
     * @return \Tati\ProcesoBundle\Entity\PerfilResponsable 
     */
    public function getPerfilResponsable()
    {
        return $this->perfilResponsable;
    }
}
