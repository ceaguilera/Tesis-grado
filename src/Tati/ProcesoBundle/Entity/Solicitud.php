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
    private $solicitante;

    /**
     * @var date
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

     /**
    *  @var integer
    * @ORM\OneToMany(targetEntity="Tati\ProcesoBundle\Entity\ActividadSolicitada",mappedBy="solicitud", cascade={"persist"})
    */
    private $actividades;



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

    /**
     * Set solicitante
     *
     * @param \Tati\ProcesoBundle\Entity\User $solicitante
     * @return Solicitud
     */
    public function setSolicitante(\Tati\ProcesoBundle\Entity\User $solicitante = null)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get solicitante
     *
     * @return \Tati\ProcesoBundle\Entity\User 
     */
    public function getSolicitante()
    {
        return $this->solicitante;
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
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }
}
