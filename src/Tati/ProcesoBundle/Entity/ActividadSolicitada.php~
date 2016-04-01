<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ActividadSolicitada
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ActividadSolicitada
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
     * @ORM\OneToOne(targetEntity="ActividadSolicitada")
     * @ORM\JoinColumn(name="actSig_id", referencedColumnName="id")
     */
    private $actSig;

     /**
     * @ORM\OneToOne(targetEntity="ActividadSolicitada")
     * @ORM\JoinColumn(name="actAnt_id", referencedColumnName="id")
     */
    private $actAnt;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Responsable", inversedBy="actividades")
     * @ORM\JoinColumn(name="responsable_id", referencedColumnName="id")
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Tati\ProcesoBundle\Entity\Solicitud", inversedBy="actividades", cascade={"persist"})
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
    private $solicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo", type="string", length=100)
     */
    private $tiempo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="TareaSolicitada", mappedBy="actividades", cascade={"persist"})
     */
    private $tareas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tareas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ActividadSolicitada
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
     * @return ActividadSolicitada
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
     * Set tiempo
     *
     * @param string $tiempo
     * @return ActividadSolicitada
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return string 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return ActividadSolicitada
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
     * Set idResponsable
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $idResponsable
     * @return ActividadSolicitada
     */
    public function setIdResponsable(\Tati\ProcesoBundle\Entity\Responsable $idResponsable = null)
    {
        $this->idResponsable = $idResponsable;

        return $this;
    }

    /**
     * Get idResponsable
     *
     * @return \Tati\ProcesoBundle\Entity\Responsable 
     */
    public function getIdResponsable()
    {
        return $this->idResponsable;
    }

    /**
     * Set solicitud
     *
     * @param \Tati\ProcesoBundle\Entity\Solicitud $solicitud
     * @return ActividadSolicitada
     */
    public function setSolicitud(\Tati\ProcesoBundle\Entity\Solicitud $solicitud = null)
    {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * Get solicitud
     *
     * @return \Tati\ProcesoBundle\Entity\Solicitud 
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Add tareas
     *
     * @param \Tati\ProcesoBundle\Entity\TareaSolicitada $tareas
     * @return ActividadSolicitada
     */
    public function addTarea(\Tati\ProcesoBundle\Entity\TareaSolicitada $tareas)
    {
        $this->tareas[] = $tareas;

        return $this;
    }

    /**
     * Remove tareas
     *
     * @param \Tati\ProcesoBundle\Entity\TareaSolicitada $tareas
     */
    public function removeTarea(\Tati\ProcesoBundle\Entity\TareaSolicitada $tareas)
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
     * Set responsable
     *
     * @param \Tati\ProcesoBundle\Entity\Responsable $responsable
     * @return ActividadSolicitada
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

    /**
     * Set ActSig
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actSig
     * @return ActividadSolicitada
     */
    public function setActSig(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actSig = null)
    {
        $this->ActSig = $actSig;

        return $this;
    }

    /**
     * Get ActSig
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActSig()
    {
        return $this->ActSig;
    }

    /**
     * Set ActAnt
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actAnt
     * @return ActividadSolicitada
     */
    public function setActAnt(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actAnt = null)
    {
        $this->ActAnt = $actAnt;

        return $this;
    }

    /**
     * Get ActAnt
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActAnt()
    {
        return $this->ActAnt;
    }
}
