<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * TareaSolicitada
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TareaSolicitada
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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    //esto esta en veremos para el menejo de documentos
    //private $documento;

    /**
     * @ORM\ManyToOne(targetEntity="ActividadSolicitada", inversedBy="tareas", cascade={"persist"})
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     */
    private $actividad;





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
     * @return TareaSolicitada
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
     * @return TareaSolicitada
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
     * Set status
     *
     * @param boolean $status
     * @return TareaSolicitada
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tipoTarea
     *
     * @param \Tati\ProcesoBundle\Entity\TipoTarea $tipoTarea
     * @return TareaSolicitada
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
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return TareaSolicitada
     */
    public function setActividades(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades = null)
    {
        $this->actividades = $actividades;

        return $this;
    }

    /**
     * Get actividades
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Set actividad
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividad
     * @return TareaSolicitada
     */
    public function setActividad(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActividad()
    {
        return $this->actividad;
    }
}
