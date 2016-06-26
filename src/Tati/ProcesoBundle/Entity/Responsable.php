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
class Responsable
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
    * @ORM\Column(name="rutaCarpeta", type="string", length=100, nullable=true)
    */
    private $rutaCarpeta;

    /**
     * @ORM\OneToMany(targetEntity="Actividad", mappedBy="responsable", cascade={"persist"})
     */
    private $actividades;

    /**
     * @ORM\OneToMany(targetEntity="ActividadSolicitada", mappedBy="responsable", cascade={"persist"})
     */
    private $actividadesSolicitadas;
    
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actividadesSolicitadas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Responsable
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
     * Set rutaCarpeta
     *
     * @param string $rutaCarpeta
     * @return Responsable
     */
    public function setRutaCarpeta($rutaCarpeta)
    {
        $this->rutaCarpeta = $rutaCarpeta;

        return $this;
    }

    /**
     * Get rutaCarpeta
     *
     * @return string 
     */
    public function getRutaCarpeta()
    {
        return $this->rutaCarpeta;
    }

    /**
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\Actividad $actividades
     * @return Responsable
     */
    public function addActividade(\Tati\ProcesoBundle\Entity\Actividad $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \Tati\ProcesoBundle\Entity\Actividad $actividades
     */
    public function removeActividade(\Tati\ProcesoBundle\Entity\Actividad $actividades)
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
     * Add actividadesSolicitadas
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSolicitadas
     * @return Responsable
     */
    public function addActividadesSolicitada(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSolicitadas)
    {
        $this->actividadesSolicitadas[] = $actividadesSolicitadas;

        return $this;
    }

    /**
     * Remove actividadesSolicitadas
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSolicitadas
     */
    public function removeActividadesSolicitada(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSolicitadas)
    {
        $this->actividadesSolicitadas->removeElement($actividadesSolicitadas);
    }

    /**
     * Get actividadesSolicitadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividadesSolicitadas()
    {
        return $this->actividadesSolicitadas;
    }
}
