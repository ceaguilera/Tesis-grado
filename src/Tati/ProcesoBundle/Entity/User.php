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
     * @ORM\OneToOne(targetEntity="PerfilSolicitante", inversedBy="user",  cascade={"persist"})
     * @ORM\JoinColumn(name="sSolicitante_id", referencedColumnName="id")
     */
    private $perfilSolicitante;

    /**
     * @ORM\OneToOne(targetEntity="PerfilResponsable", inversedBy="user",  cascade={"persist"})
     * @ORM\JoinColumn(name="pResponsable_id", referencedColumnName="id")
     */
    private $perfilResponsable;

    /**
     * @ORM\OneToMany(targetEntity="Notificaciones", mappedBy="receptor", cascade={"persist"})
     */
    private $notificaciones;


    /**
     * Add notificaciones
     *
     * @param \Tati\ProcesoBundle\Entity\Notificaciones $notificaciones
     * @return User
     */
    public function addNotificacione(\Tati\ProcesoBundle\Entity\Notificaciones $notificaciones)
    {
        $this->notificaciones[] = $notificaciones;

        return $this;
    }

    /**
     * Remove notificaciones
     *
     * @param \Tati\ProcesoBundle\Entity\Notificaciones $notificaciones
     */
    public function removeNotificacione(\Tati\ProcesoBundle\Entity\Notificaciones $notificaciones)
    {
        $this->notificaciones->removeElement($notificaciones);
    }

    /**
     * Get notificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotificaciones()
    {
        return $this->notificaciones;
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
}
