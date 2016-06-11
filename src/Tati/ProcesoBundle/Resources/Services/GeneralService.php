<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\User as EUser;
use Tati\ProcesoBundle\Entity\Departamento as EDep;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUni;
use Tati\ProcesoBundle\Entity\PerfilSolicitante as EPS;
use Tati\ProcesoBundle\Entity\PerfilResponsable as EPR;
use Tati\ProcesoBundle\Entity\Responsable as EResponsanble;

class GeneralService
{
	private $em;
	/**
     * Constructor del servicio
     *
     */
    public function __construct($em)
    {
        $this->em= $em;
    }

    public function getTareas($id){
        $actividad = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->find($id);
        $response = array();
        $response['actividad'] = array();
        $response['actividad']['nombre'] = $actividad->getNombre();
        $response['actividad']['id'] = $actividad->getId();
        $response['actividad']['descripcion'] = $actividad->getDescripcion();
        $tareas = array();
        foreach ($actividad->getTareas() as $tarea) {
            $tareaAux = array();
            $tareaAux['id'] = $tarea->getId();
            $tareaAux['nombre'] = $tarea->getNombre();
            $tareaAux['tipo'] = $tarea->getTipoTarea()->getId();
            array_push($tareas, $tareaAux);
        }
        $response['actividad']['tareas'] = $tareas;

        return $response;
    }




}
