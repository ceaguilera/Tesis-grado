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
     * @ORM\OneToOne(targetEntity="ActividadSolicitada", cascade={"persist"})
     * @ORM\JoinColumn(name="actSig_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $actSig;

     /**
     * @ORM\OneToOne(targetEntity="ActividadSolicitada", cascade={"persist"})
     * @ORM\JoinColumn(name="actAnt_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
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
     * @ORM\JoinColumn(name="responsable_id", referencedColumnName="id", nullable=true)
     */
    private $responsable;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="actividades")
     * @ORM\JoinColumn(name="solicitante_id", referencedColumnName="id", nullable=true)
     */
    private $solicitante;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Tati\ProcesoBundle\Entity\Solicitud", inversedBy="actividades", cascade={"persist"})
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
    private $solicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo", type="integer")
     */
    private $tiempo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activa", type="boolean", nullable=true)
     */
    private $activa;

    /**
     * @ORM\OneToMany(targetEntity="TareaSolicitada", mappedBy="actividad", cascade={"persist"})
     */
    private $tareas;

    /**
     * @var date
     *
     * @ORM\Column(name="fecha_activacion", type="date", nullable=true)
     */
    private $fechaActivacion;

    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="actividades_sol", cascade={"persist"})
     */
    private $documentos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notificacionVencida", type="boolean", nullable=true)
     */
    private $notificacionVencida;

    /**
     * @ORM\OneToMany(targetEntity="Notificaciones", mappedBy="actividad", cascade={"persist"})
     */
    private $notificaciones;
    /**
     * Constructor
     */

    /**
     * @var integer
     * -2 Inicio
     * -1 fin
     *
     * @ORM\Column(name="inciofin", type="integer", nullable=true)
     */
    private $InicioFin;

    public function __construct()
    {
        $this->tareas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notificacionVencida = false;
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
     * Set actSig
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actSig
     * @return ActividadSolicitada
     */
    public function setActSig(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actSig = null)
    {
        $this->actSig = $actSig;

        return $this;
    }

    /**
     * Get actSig
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActSig()
    {
        return $this->actSig;
    }

    /**
     * Set actAnt
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actAnt
     * @return ActividadSolicitada
     */
    public function setActAnt(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actAnt = null)
    {
        $this->actAnt = $actAnt;

        return $this;
    }

    /**
     * Get actAnt
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActAnt()
    {
        return $this->actAnt;
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
     * Set activa
     *
     * @param boolean $activa
     * @return ActividadSolicitada
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return boolean 
     */
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set fechaActivacion
     *
     * @param \DateTime $fechaActivacion
     * @return ActividadSolicitada
     */
    public function setFechaActivacion($fechaActivacion)
    {
        $this->fechaActivacion = $fechaActivacion;

        return $this;
    }

    /**
     * Get fechaActivacion
     *
     * @return \DateTime 
     */
    public function getFechaActivacion()
    {
        return $this->fechaActivacion;
    }

    /**
     * Set tiempo
     *
     * @param integer $tiempo
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
     * @return integer 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Add documentos
     *
     * @param \Tati\ProcesoBundle\Entity\Documento $documentos
     * @return ActividadSolicitada
     */
    public function addDocumento(\Tati\ProcesoBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \Tati\ProcesoBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\Tati\ProcesoBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set notificacionVencida
     *
     * @param boolean $notificacionVencida
     * @return ActividadSolicitada
     */
    public function setNotificacionVencida($notificacionVencida)
    {
        $this->notificacionVencida = $notificacionVencida;

        return $this;
    }

    /**
     * Get notificacionVencida
     *
     * @return boolean 
     */
    public function getNotificacionVencida()
    {
        return $this->notificacionVencida;
    }

    /**
     * Add notificaciones
     *
     * @param \Tati\ProcesoBundle\Entity\Notificaciones $notificaciones
     * @return ActividadSolicitada
     */
    public function addNotificacione(\Tati\ProcesoBundle\Entity\Notificaciones $notificaciones)
    {
        $this->notificaciones[] = $notificaciones;

        return $this;
    }

    /**
     * Remove notificaciones
     *
     * @param \Tati\ProcesoBundle\Entity\Notificaciones $notificaciones
     */
    public function removeNotificacione(\Tati\ProcesoBundle\Entity\Notificaciones $notificaciones)
    {
        $this->notificaciones->removeElement($notificaciones);
    }

    /**
     * Get notificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotificaciones()
    {
        return $this->notificaciones;
    }

    /**
     * Set solicitante
     *
     * @param \Tati\ProcesoBundle\Entity\User $solicitante
     * @return ActividadSolicitada
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
     * Set InicioFin
     *
     * @param integer $inicioFin
     * @return ActividadSolicitada
     */
    public function setInicioFin($inicioFin)
    {
        $this->InicioFin = $inicioFin;

        return $this;
    }

    /**
     * Get InicioFin
     *
     * @return integer 
     */
    public function getInicioFin()
    {
        return $this->InicioFin;
    }
}
