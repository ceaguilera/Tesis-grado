<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * PerfilSolicitante
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PerfilSolicitante
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
     * @var integer
     *
     */
    private $cedula;

    /**
     * @ORM\OneToMany(targetEntity="ActividadSolicitada", mappedBy="usuarioSolicitante", cascade={"persist"})
     */
    private $actividades;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaCarpeta", type="string", length=100)
     */
    private $rutaCarpeta;

    /**
     * @ORM\OneToOne(targetEntity="Departamento")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    private $departamento;

    /**
     * @ORM\OneToOne(targetEntity="UnidadAcademica")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidadAcademcia;

    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="usuarioSolicitante", cascade={"persist"})
     */
    private $documentos;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="PerfilSolicitante")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
 

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PerfilSolicitante
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
     * @return PerfilSolicitante
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
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividades
     * @return PerfilSolicitante
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

    /**
     * Set departamento
     *
     * @param \Tati\ProcesoBundle\Entity\Departamento $departamento
     * @return PerfilSolicitante
     */
    public function setDepartamento(\Tati\ProcesoBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Tati\ProcesoBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set unidadAcademcia
     *
     * @param \Tati\ProcesoBundle\Entity\UnidadAcademica $unidadAcademcia
     * @return PerfilSolicitante
     */
    public function setUnidadAcademcia(\Tati\ProcesoBundle\Entity\UnidadAcademica $unidadAcademcia = null)
    {
        $this->unidadAcademcia = $unidadAcademcia;

        return $this;
    }

    /**
     * Get unidadAcademcia
     *
     * @return \Tati\ProcesoBundle\Entity\UnidadAcademica 
     */
    public function getUnidadAcademcia()
    {
        return $this->unidadAcademcia;
    }

    /**
     * Add documentos
     *
     * @param \Tati\ProcesoBundle\Entity\Documento $documentos
     * @return PerfilSolicitante
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
     * Set user
     *
     * @param \Tati\ProcesoBundle\Entity\User $user
     * @return PerfilSolicitante
     */
    public function setUser(\Tati\ProcesoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Tati\ProcesoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
