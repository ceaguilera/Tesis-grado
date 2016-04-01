<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * Solicitud
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Solicitud
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
     * @ORM\ManyToOne(targetEntity="Proceso")
     * @ORM\JoinColumn(name="id_proceso", referencedColumnName="id")
     */
    private $proceso;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="idSolicitante", referencedColumnName="id")
     */
    private $idSolicitante;

    /**
     * @var date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

     /**
    *  @var integer
    * @ORM\OneToMany(targetEntity="Tati\ProcesoBundle\Entity\ActividadSolicitada",mappedBy="solicitud", cascade={"persist"})
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Solicitud
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idProceso
     *
     * @param \Tati\ProcesoBundle\Entity\Proceso $idProceso
     * @return Solicitud
     */
    public function setIdProceso(\Tati\ProcesoBundle\Entity\Proceso $idProceso = null)
    {
        $this->idProceso = $idProceso;

        return $this;
    }

    /**
     * Get idProceso
     *
     * @return \Tati\ProcesoBundle\Entity\Proceso 
     */
    public function getIdProceso()
    {
        return $this->idProceso;
    }

    /**
     * Set idSolicitante
     *
     * @param \Tati\ProcesoBundle\Entity\User $idSolicitante
     * @return Solicitud
     */
    public function setIdSolicitante(\Tati\ProcesoBundle\Entity\User $idSolicitante = null)
    {
        $this->idSolicitante = $idSolicitante;

        return $this;
    }

    /**
     * Get idSolicitante
     *
     * @return \Tati\ProcesoBundle\Entity\User 
     */
    public function getIdSolicitante()
    {
        return $this->idSolicitante;
    }

    /**
     * Set actividades
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return Solicitud
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
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actividades
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return Solicitud
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
     * Set proceso
     *
     * @param \Tati\ProcesoBundle\Entity\Proceso $proceso
     * @return Solicitud
     */
    public function setProceso(\Tati\ProcesoBundle\Entity\Proceso $proceso = null)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return \Tati\ProcesoBundle\Entity\Proceso 
     */
    public function getProceso()
    {
        return $this->proceso;
    }
}
