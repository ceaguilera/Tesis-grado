<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;    

/**
 * Proceso
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Proceso
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
     * @ORM\Column(name="descripcion", type="string", length=200)
     */
    private $descripcion;

    /**
    *  @var integer
    * @ORM\OneToMany(targetEntity="Tati\ProcesoBundle\Entity\Actividad", mappedBy="Proceso", cascade={"persist"})
    * @ORM\OrderBy({"id" = "ASC"})
    */
    private $actividades;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
    *
    * @ORM\OneToMany(targetEntity="Tati\ProcesoBundle\Entity\Solicitud", mappedBy="proceso", cascade={"persist"})
    */
    private $solicitudes;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Proceso
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
     * @return Proceso
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
     * @return Proceso
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
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\Actividad $actividades
     * @return Proceso
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
     * Add solicitudes
     *
     * @param \Tati\ProcesoBundle\Entity\Solicitud $solicitudes
     * @return Proceso
     */
    public function addSolicitude(\Tati\ProcesoBundle\Entity\Solicitud $solicitudes)
    {
        $this->solicitudes[] = $solicitudes;

        return $this;
    }

    /**
     * Remove solicitudes
     *
     * @param \Tati\ProcesoBundle\Entity\Solicitud $solicitudes
     */
    public function removeSolicitude(\Tati\ProcesoBundle\Entity\Solicitud $solicitudes)
    {
        $this->solicitudes->removeElement($solicitudes);
    }

    /**
     * Get solicitudes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudes()
    {
        return $this->solicitudes;
    }

    //set proceso
    public function setProceso($data)
    {
        $this->nombre = $data['nombre'];
        $this->descripcion = $data['descripcion'];
        $this->status = true;

        return $this;
    }
}
