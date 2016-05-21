<?php

namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 

/**
 * Notificaciones
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Notificaciones
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
    * @var dateTime
    * @ORM\Column(type="datetime") 
    */
    private $fecha;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $visto;

    /**
    * Tipo de notifiacion:
    * 1. Basica
    * 2. Alerta
    *
    * @var integer
    * @ORM\Column(type="integer")
    * 
    */
    private $tipo;

    /**
     * @ORM\Column(type="json_array")
     * 
     */
    private $datos;

    /**
     * @ORM\ManyToOne(targetEntity="user", inversedBy="notificaciones")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $receptor;

    /**
    * @var string
    * @ORM\Column(type="string")
    * 
    */
    private $mensaje;

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
     * @return Notificaciones
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
     * Set visto
     *
     * @param boolean $visto
     * @return Notificaciones
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return boolean 
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Notificaciones
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set datos
     *
     * @param array $datos
     * @return Notificaciones
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    /**
     * Get datos
     *
     * @return array 
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set receptor
     *
     * @param \Tati\ProcesoBundle\Entity\user $receptor
     * @return Notificaciones
     */
    public function setReceptor(\Tati\ProcesoBundle\Entity\user $receptor = null)
    {
        $this->receptor = $receptor;

        return $this;
    }

    /**
     * Get receptor
     *
     * @return \Tati\ProcesoBundle\Entity\user 
     */
    public function getReceptor()
    {
        return $this->receptor;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return Notificaciones
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }
}
