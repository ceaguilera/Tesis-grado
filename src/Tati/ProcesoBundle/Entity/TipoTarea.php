<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * TipoTarea
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoTarea
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
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="Tarea", mappedBy="TipoTarea", cascade={"persist"})
     */
    private $tareas;

    /**
     * @ORM\OneToMany(targetEntity="TareaSolicitada", mappedBy="TipoTarea", cascade={"persist"})
     */
    private $tareasSolicitadas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tareas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tareasSolicitadas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return TipoTarea
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return TipoTarea
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add tareas
     *
     * @param \Tati\ProcesoBundle\Entity\Tarea $tareas
     * @return TipoTarea
     */
    public function addTarea(\Tati\ProcesoBundle\Entity\Tarea $tareas)
    {
        $this->tareas[] = $tareas;

        return $this;
    }

    /**
     * Remove tareas
     *
     * @param \Tati\ProcesoBundle\Entity\Tarea $tareas
     */
    public function removeTarea(\Tati\ProcesoBundle\Entity\Tarea $tareas)
    {
        $this->tareas->removeElement($tareas);
    }

    /**
     * Get tareas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTareas()
    {
        return $this->tareas;
    }

    /**
     * Add tareasSolicitadas
     *
     * @param \Tati\ProcesoBundle\Entity\TareaSolicitada $tareasSolicitadas
     * @return TipoTarea
     */
    public function addTareasSolicitada(\Tati\ProcesoBundle\Entity\TareaSolicitada $tareasSolicitadas)
    {
        $this->tareasSolicitadas[] = $tareasSolicitadas;

        return $this;
    }

    /**
     * Remove tareasSolicitadas
     *
     * @param \Tati\ProcesoBundle\Entity\TareaSolicitada $tareasSolicitadas
     */
    public function removeTareasSolicitada(\Tati\ProcesoBundle\Entity\TareaSolicitada $tareasSolicitadas)
    {
        $this->tareasSolicitadas->removeElement($tareasSolicitadas);
    }

    /**
     * Get tareasSolicitadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTareasSolicitadas()
    {
        return $this->tareasSolicitadas;
    }
}
