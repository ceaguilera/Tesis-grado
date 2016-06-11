<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * Responsable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UnidadAcademica
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Tati\ProcesoBundle\Entity\Departamento", inversedBy="unidadesAcademicas", cascade={"persist"})
     * @ORM\JoinColumn(name="departameto_id", referencedColumnName="id")
     */
    private $departamento;

    /**
     * @ORM\OneToMany(targetEntity="PerfilResponsable", mappedBy="unidadAcademica")
     */
    private $responsable;

    /**
     * @ORM\OneToMany(targetEntity="PerfilSolicitante", mappedBy="unidadAcademica")
     */
    private $solicitante;
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
     * @return UnidadAcademica
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
     * Set departamento
     *
     * @param \Tati\ProcesoBundle\Entity\Departamento $departamento
     * @return UnidadAcademica
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
     * Constructor
     */
    public function __construct()
    {
        $this->responsable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitante = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add responsable
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilResponsable $responsable
     * @return UnidadAcademica
     */
    public function addResponsable(\Tati\ProcesoBundle\Entity\PerfilResponsable $responsable)
    {
        $this->responsable[] = $responsable;

        return $this;
    }

    /**
     * Remove responsable
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilResponsable $responsable
     */
    public function removeResponsable(\Tati\ProcesoBundle\Entity\PerfilResponsable $responsable)
    {
        $this->responsable->removeElement($responsable);
    }

    /**
     * Get responsable
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Add solicitante
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilSolicitante $solicitante
     * @return UnidadAcademica
     */
    public function addSolicitante(\Tati\ProcesoBundle\Entity\PerfilSolicitante $solicitante)
    {
        $this->solicitante[] = $solicitante;

        return $this;
    }

    /**
     * Remove solicitante
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilSolicitante $solicitante
     */
    public function removeSolicitante(\Tati\ProcesoBundle\Entity\PerfilSolicitante $solicitante)
    {
        $this->solicitante->removeElement($solicitante);
    }

    /**
     * Get solicitante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }
}
