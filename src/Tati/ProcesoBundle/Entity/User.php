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
     * @ORM\OneToMany(targetEntity="Notificaciones", mappedBy="receptor", cascade={"persist"})
     */
    private $notificaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cedula", type="integer", nullable=true)
     */
    private $cedula;

    /**
     * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="responsable")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    private $departamento;

    /**
     * @ORM\ManyToOne(targetEntity="UnidadAcademica", inversedBy="responsable")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidadAcademcia;

    /**
     * @ORM\ManyToMany(targetEntity="Responsable", inversedBy="users", cascade={"persist"})
     * @ORM\JoinTable(name="users_responsable")
     */
    private $responsabilidades;

    /**
    * @ORM\OneToMany(targetEntity="ActividadSolicitada", mappedBy="user", cascade={"persist"})
    */
    private $actividades;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

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
     * Set departamento
     *
     * @param \Tati\ProcesoBundle\Entity\Departamento $departamento
     * @return User
     */
    public function setDepartamento(\Tati\ProcesoBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Tati\ProcesoBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set unidadAcademcia
     *
     * @param \Tati\ProcesoBundle\Entity\UnidadAcademica $unidadAcademcia
     * @return User
     */
    public function setUnidadAcademcia(\Tati\ProcesoBundle\Entity\UnidadAcademica $unidadAcademcia = null)
    {
        $this->unidadAcademcia = $unidadAcademcia;

        return $this;
    }

    /**
     * Get unidadAcademcia
     *
     * @return \Tati\ProcesoBundle\Entity\UnidadAcademica 
     */
    public function getUnidadAcademcia()
    {
        return $this->unidadAcademcia;
    }

    /**
     * Add responsabilidades
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $responsabilidades
     * @return User
     */
    public function addResponsabilidade(\Tati\ProcesoBundle\Entity\Responsable $responsabilidades)
    {
        $this->responsabilidades[] = $responsabilidades;

        return $this;
    }

    /**
     * Remove responsabilidades
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $responsabilidades
     */
    public function removeResponsabilidade(\Tati\ProcesoBundle\Entity\Responsable $responsabilidades)
    {
        $this->responsabilidades->removeElement($responsabilidades);
    }

    /**
     * Get responsabilidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsabilidades()
    {
        return $this->responsabilidades;
    }

    /**
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return User
     */
    public function addActividade(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     */
    public function removeActividade(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    /**
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Set cedula
     *
     * @param integer $cedula
     * @return User
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return integer 
     */
    public function getCedula()
    {
        return $this->cedula;
    }
}
