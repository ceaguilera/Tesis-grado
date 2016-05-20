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
class Departamento
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
    * @ORM\OneToMany(targetEntity="UnidadAcademica", mappedBy="departamento", cascade={"persist"})
    */
    private $unidadesAcademicas;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidadesAcademicas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Departamento
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
     * Add unidadesAcademicas
     *
     * @param \Tati\ProcesoBundle\Entity\UnidadAcademica $unidadesAcademicas
     * @return Departamento
     */
    public function addUnidadesAcademica(\Tati\ProcesoBundle\Entity\UnidadAcademica $unidadesAcademicas)
    {
        $this->unidadesAcademicas[] = $unidadesAcademicas;

        return $this;
    }

    /**
     * Remove unidadesAcademicas
     *
     * @param \Tati\ProcesoBundle\Entity\UnidadAcademica $unidadesAcademicas
     */
    public function removeUnidadesAcademica(\Tati\ProcesoBundle\Entity\UnidadAcademica $unidadesAcademicas)
    {
        $this->unidadesAcademicas->removeElement($unidadesAcademicas);
    }

    /**
     * Get unidadesAcademicas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidadesAcademicas()
    {
        return $this->unidadesAcademicas;
    }
}
