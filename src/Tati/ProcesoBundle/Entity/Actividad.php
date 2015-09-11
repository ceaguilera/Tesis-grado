<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Actividad
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
     * @ORM\Column(name="id_act_sig", type="integer")
     */
    private $idActSig;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_act_ant", type="integer")
     */
    private $idActAnt;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_responsable", type="integer")
     */
    private $idResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_proceso", type="integer")
     */
    private $idProceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo", type="time")
     */
    private $tiempo;


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
     * @return Actividad
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
     * Set idActSig
     *
     * @param integer $idActSig
     * @return Actividad
     */
    public function setIdActSig($idActSig)
    {
        $this->idActSig = $idActSig;

        return $this;
    }

    /**
     * Get idActSig
     *
     * @return integer 
     */
    public function getIdActSig()
    {
        return $this->idActSig;
    }

    /**
     * Set idActAnt
     *
     * @param integer $idActAnt
     * @return Actividad
     */
    public function setIdActAnt($idActAnt)
    {
        $this->idActAnt = $idActAnt;

        return $this;
    }

    /**
     * Get idActAnt
     *
     * @return integer 
     */
    public function getIdActAnt()
    {
        return $this->idActAnt;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Actividad
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set idResponsable
     *
     * @param integer $idResponsable
     * @return Actividad
     */
    public function setIdResponsable($idResponsable)
    {
        $this->idResponsable = $idResponsable;

        return $this;
    }

    /**
     * Get idResponsable
     *
     * @return integer 
     */
    public function getIdResponsable()
    {
        return $this->idResponsable;
    }

    /**
     * Set idProceso
     *
     * @param integer $idProceso
     * @return Actividad
     */
    public function setIdProceso($idProceso)
    {
        $this->idProceso = $idProceso;

        return $this;
    }

    /**
     * Get idProceso
     *
     * @return integer 
     */
    public function getIdProceso()
    {
        return $this->idProceso;
    }

    /**
     * Set tiempo
     *
     * @param \DateTime $tiempo
     * @return Actividad
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return \DateTime 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }
}
