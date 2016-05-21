<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * PerfilResponsable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PerfilResponsable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=100)
     */
    private $cargo;

    /**
     * @ORM\OneToOne(targetEntity="Responsable")
     * @ORM\JoinColumn(name="tipoResponsable_id", referencedColumnName="id")
     */
    private $tipoResponsable;

    /**
     * @ORM\OneToMany(targetEntity="ActividadSolicitada", mappedBy="usuarioSolicitante", cascade={"persist"})
     */
    private $actividades;

    /**
     * @ORM\OneToOne(targetEntity="Departamento")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    private $departamento;

    /**
     * @ORM\OneToOne(targetEntity="UnidadAcademica")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidadAcademcia;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="PerfilResponsable")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return PerfilResponsable
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
     * Set cargo
     *
     * @param string $cargo
     * @return PerfilResponsable
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set tipoResponsable
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $tipoResponsable
     * @return PerfilResponsable
     */
    public function setTipoResponsable(\Tati\ProcesoBundle\Entity\Responsable $tipoResponsable = null)
    {
        $this->tipoResponsable = $tipoResponsable;

        return $this;
    }

    /**
     * Get tipoResponsable
     *
     * @return \Tati\ProcesoBundle\Entity\Responsable 
     */
    public function getTipoResponsable()
    {
        return $this->tipoResponsable;
    }

    /**
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return PerfilResponsable
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
     * Set departamento
     *
     * @param \Tati\ProcesoBundle\Entity\Departamento $departamento
     * @return PerfilResponsable
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
     * @return PerfilResponsable
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
     * Set user
     *
     * @param \Tati\ProcesoBundle\Entity\User $user
     * @return PerfilResponsable
     */
    public function setUser(\Tati\ProcesoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Tati\ProcesoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return PerfilResponsable
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }
}
