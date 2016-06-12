<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\Proceso as EProceso;
use Tati\ProcesoBundle\Entity\Actividad as EActividad;
use Tati\ProcesoBundle\Entity\Tarea as ETarea;
use Tati\ProcesoBundle\Entity\TipoTarea as ETipoTarea;
use Tati\ProcesoBundle\Entity\Solicitud as ESolicitud;
use Tati\ProcesoBundle\Entity\ActividadSolicitada as EActividadSolicitada;
use Tati\ProcesoBundle\Entity\TareaSolicitada as ETareaSolicitada;
use Symfony\Component\Filesystem\Filesystem;
use \DateTime;

class RequestService
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

    public function requestProcess($data){

        $solicitud = new ESolicitud();
        $proceso = $this->em->getRepository('ProcesoBundle:Proceso')->find($data['idSolicitud']);
        $solicitante = $this->em->getRepository('ProcesoBundle:User')->find($data['userId']);
        $solicitud->setProceso($proceso);
        $solicitud->setSolicitante($solicitante);
        $fecha = new \DateTime();
        $solicitud->setFecha($fecha);
        $actividadesProcesoPadre = $proceso->getActividades();
        
        foreach ($actividadesProcesoPadre as $actividadPP) {
            $actividadSol = new EActividadSolicitada;
            if($actividadPP->getResponsable()->getNombre() == "Solicitante"){
                $actividadSol->setSolicitante($data['solicitante']);
            }
            $tareasPP = $actividadPP->getTareas();
            foreach ($tareasPP as $tareaPP) {
                $tareaSol = new ETareaSolicitada;
                $tareaSol->setNombre($tareaPP->getNombre());
                $tareaSol->setDescripcion($tareaPP->getDescripcion());
                $tareaPP->getTipoTarea()->addTareasSolicitada($tareaSol);
                $tareaSol->setTipoTarea($tareaPP->getTipoTarea());
                $tareaSol->setStatus(false);
                $actividadSol->addTarea($tareaSol);
                $tareaSol->setActividad($actividadSol);
            }
            $actividadSol->setResponsable($actividadPP->getResponsable());
            $actividadSol->setSolicitud($solicitud);
            $solicitud->addActividade($actividadSol);
            $actividadSol->setStatus(false);
            $actividadSol->setTiempo($actividadPP->getTiempo());
            $actividadSol->setNombre($actividadPP->getNombre());
            $actividadSol->setDescripcion($actividadPP->getDescripcion());
        }
        $this->em->persist($solicitud);
        $this->em->flush();

        //se define el nombre de la carpeta de la solicitud
        $carpeta = "solicitud-".$solicitud->getId()."-user-"
        .$data['userId']."-fecha-".$fecha->format('d-m-Y-H:i:s');
        $direcrotioRaiz = __DIR__."/../../../../../web/uploads"; //nombre del la carpte raiz

        //se crea la carpeta
        //$fs = new Filesystem();
        $directoriodeSolicitud = $direcrotioRaiz."/".$carpeta;
        mkdir($directoriodeSolicitud, 0777, true);
        
        $solicitud->setNombreCarpeta($carpeta);
        $actividadesSolicitadas = $solicitud->getActividades();
        //creando las relaciones entre las actividades de la solicitud
        foreach ($actividadesProcesoPadre as $key => $actividadPP) {
            //var_dump($key);
            $posSig = $actividadesProcesoPadre->indexOf($actividadPP->getActSig());
            //var_dump($posSig);
            //$posAnt = $actividadesProcesoPadre->indexOf($actividadPP->getActAnt());
            //var_dump($actividadesProcesoPadre->get($posSig)->getProceso()->getNombre());
            if($posSig!=false){
            $actividad = $actividadesSolicitadas->get($key);
            $actividad2 = $actividadesSolicitadas->get($posSig);
            $actividad->setActSig($actividad2);
            $actividad2->setActAnt($actividad);
            // var_dump($actividad->getNombre());
            // var_dump($actividad->getId());
            // var_dump($actividad->getActSig()->getNombre());
            // var_dump($actividad->getActSig()->getId());
            // var_dump($actividad2->getActAnt()->getNombre());
            // var_dump($actividad2->getActAnt()->getId());
            //var_dump("sadas",get_class($actividad));
            //var_dump($actividad->getActSig()->getSolicitud()->getId());
            $this->em->persist($actividad);
            $this->em->persist($actividad2);
            $this->em->flush();

            // $actividad->setActAnt($actividadesSolicitadas->get($posAnt));
            // $this->em->persist($actividad);
            // $this->em->flush();
            }
            //var_dump('fin');   
        }

        $actividadSolicitud = $solicitud->getActividades();
        //var_dump($actividadSolicitud[0]->getResponsable()->getId());
        $response = array();
        if($actividadSolicitud[0]->getResponsable()->getId() == 5){
            $response['actividad'] = true;
            $response['idActividad'] = $actividadSolicitud[0]->getId();
        }else{
            $response['actividad'] = false;
        }

        return $response;
    }

    public function listaActividadesSol($data){
        $actividades = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->findBy(array(
        'solicitante' => $data['idSolicitante']));

        $response = array();

        foreach ($actividades as $actividad) {
            $actiAux = array();
            $actiAux['id'] = $actividad->getId();
            $actiAux['nombre'] = $actividad->getNombre();
            $actiAux['descripcion'] = $actividad->getDescripcion();
            $actiAux['nombreProceso'] = $actividad->getSolicitud()->getProceso()->getNombre();
            array_push($response, $actiAux);
        }

        return $response;
    }


}
