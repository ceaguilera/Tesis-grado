<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\Proceso as EProceso;
use Tati\ProcesoBundle\Entity\Actividad as EActividad;
use Tati\ProcesoBundle\Entity\Tarea as ETarea;
use Tati\ProcesoBundle\Entity\TipoTarea as ETipoTarea;
use Tati\ProcesoBundle\Entity\Solicitud as ESolicitud;
use Tati\ProcesoBundle\Entity\ActividadSolicitada as EActividadSolicitada;
use Tati\ProcesoBundle\Entity\TareaSolicitada as ETareaSolicitada;

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
        //$solicitud->setFecha($data['fecha']);
        $actividadesProcesoPadre = $proceso->getActividades();

        foreach ($actividadesProcesoPadre as $actividadPP) {
            $actividadSol = new EActividadSolicitada;
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
            var_dump($actividad->getNombre());
            var_dump($actividad->getId());
            var_dump($actividad->getActSig()->getNombre());
            var_dump($actividad->getActSig()->getId());
            var_dump($actividad2->getActAnt()->getNombre());
            var_dump($actividad2->getActAnt()->getId());
            //var_dump("sadas",get_class($actividad));
            //var_dump($actividad->getActSig()->getSolicitud()->getId());
            $this->em->persist($actividad);
            $this->em->persist($actividad2);
            $this->em->flush();

            // $actividad->setActAnt($actividadesSolicitadas->get($posAnt));
            // $this->em->persist($actividad);
            // $this->em->flush();
            }
            var_dump('fin');   
        }


    }



}
