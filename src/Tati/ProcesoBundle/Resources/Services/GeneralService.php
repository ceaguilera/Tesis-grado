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
            $tareaAux['descripcion'] = $tarea->getDescripcion();
            if($tareaAux['tipo'] == 2){
                $documentos = array();
                $documentosRelacionados = $this->em->getRepository('ProcesoBundle:Documento')
                ->findBy(array('actividades_sol' => $id));
                foreach ($documentosRelacionados as $documento) {
                    $docAux['nombre'] = $documento->getName();
                    $docAux['path'] = $documento-> getPath();
                    array_push($documentos, $docAux);
                }
                $tareaAux['documentos'] = $documentos;
            }
            array_push($tareas, $tareaAux);
        }
        $response['actividad']['tareas'] = $tareas;

        return $response;
    }

    public function setStatusTareasSolicitadas($id){
        $tarea = $this->em->getRepository('ProcesoBundle:TareaSolicitada')->find($id);
        $tarea->setStatus(true);
        $this->em->persist($tarea);
        $this->em->flush();
    }

    public function setStatusActividadSolicitada($id){
        $actividad = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->find($id);
        $tareas = $actividad->getTareas();

        $fallo = false;

        foreach ($tareas as $tarea) {
            if(!$tarea->getStatus())
                $fallo = true;
        }

        if($fallo){
            return false;
        }else{
            $actividad->setStatus(true);
            $actividadSig = $actividad->getActSig();
            if($actividadSig != null){
                $documentos = $this->em->getRepository('ProcesoBundle:Documento')
                ->findBy(array('actividades_sol' => $id));
                foreach ($documentos as $key => $documento) {
                    $documento->setActividadesSol($actividadSig);
                    $this->em->persist($documento);
                    $this->em->flush();
                }
                $actividadSig->setActiva(true);                
            }
            $actividad->setActiva(false);
            $this->em->persist($tarea);
            $this->em->flush();
            return true;     
        }
    }




}
