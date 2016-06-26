<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * Tarea
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tarea
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
     * @ORM\Column(name="descripcion", type="string", length=250)
     */
    private $descripcion;


    /**
     * @ORM\ManyToOne(targetEntity="TipoTarea", inversedBy="tareas", cascade={"persist"})
     * @ORM\JoinColumn(name="tipoTarea_id", referencedColumnName="id")
     */
    private $tipoTarea;

    /**
     * @ORM\ManyToOne(targetEntity="Actividad", inversedBy="tareas", cascade={"persist"})
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     */
    private $actividades;


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
     * @return Tarea
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
     * Set slug
     *
     * @param string $slug
     * @return Tarea
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\tarea $actividades
     * @return Tarea
     */
    public function addActividade(\Tati\ProcesoBundle\Entity\Actividad $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \Tati\ProcesoBundle\Entity\tarea $actividades
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tarea
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
     * Set tipoTarea
     *
     * @param \Tati\ProcesoBundle\Entity\TipoTarea $tipoTarea
     * @return Tarea
     */
    public function setTipoTarea(\Tati\ProcesoBundle\Entity\TipoTarea $tipoTarea = null)
    {
        $this->tipoTarea = $tipoTarea;

        return $this;
    }

    /**
     * Get tipoTarea
     *
     * @return \Tati\ProcesoBundle\Entity\TipoTarea 
     */
    public function getTipoTarea()
    {
        return $this->tipoTarea;
    }

    /**
     * Set actividades
     *
     * @param \Tati\ProcesoBundle\Entity\Actividad $actividades
     * @return Tarea
     */
    public function setActividades(\Tati\ProcesoBundle\Entity\Actividad $actividades = null)
    {
        $this->actividades = $actividades;

        return $this;
    }

    /**
    *
    * Set tarea
    */
    public function setTarea($data)
    {
        $this->nombre = $data['nombre'];
        $this->descripcion= $data['descripcion'];
    }
}
