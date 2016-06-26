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
     * @ORM\Column(name="cargo", type="string", length=100)
     */
    private $cargo;


    /**
     * @ORM\OneToOne(targetEntity="Responsable")
     * @ORM\JoinColumn(name="tipoResponsable_id", referencedColumnName="id")
     */
    private $responsable;


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
     * @ORM\OneToOne(targetEntity="User", mappedBy="perfilResponsable", cascade={"persist"})
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
     * Set responsable
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $responsable
     * @return PerfilResponsable
     */
    public function setResponsable(\Tati\ProcesoBundle\Entity\Responsable $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \Tati\ProcesoBundle\Entity\Responsable 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
}
