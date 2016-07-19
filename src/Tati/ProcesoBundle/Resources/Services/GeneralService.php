<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\User as EUser;
use Tati\ProcesoBundle\Entity\Departamento as EDep;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUni;
use Tati\ProcesoBundle\Entity\PerfilSolicitante as EPS;
use Tati\ProcesoBundle\Entity\PerfilResponsable as EPR;
use Tati\ProcesoBundle\Entity\Responsable as EResponsanble;
use Tati\ProcesoBundle\Entity\Notificaciones as ENotificacion;
use Symfony\Component\HttpFoundation\Session\Session;
//use Tati\ProcesoBundle\Adapter\CoreSession;
//use Tati\ProcesoBundle\Adapter\CoreTranslator;
use \DateTime;

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

    public function eliminarArvhivo($id){
        $documento = $this->em->getRepository('ProcesoBundle:Documento')->find($id);
        $actividad = $documento->getActividadesSol();
        $actividad->removeDocumento($documento);
        $documento->setActividadesSol(null);
        $tarea = $documento->getTarea();
        $tarea->setDocumento(null);
        $documento->setTarea(null);
        $path = $documento->getPath();
        if(unlink($path)){
            $this->em->remove($documento);
            $this->em->flush();
            return true;
        }
    }
    public function getTareas($id){
        $actividad = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->find($id);
        $response = array();
        $response['actividad'] = array();
        $response['actividad']['nombre'] = $actividad->getNombre();
        $response['actividad']['id'] = $actividad->getId();
        $response['actividad']['descripcion'] = $actividad->getDescripcion();
        $response['actividad']['mensaje'] = $actividad->getMensajeDevulucion();
        $tareas = array();
        foreach ($actividad->getTareas() as $tarea) {
            $tareaAux = array();
            $tareaAux['id'] = $tarea->getId();
            $tareaAux['nombre'] = $tarea->getNombre();
            $tareaAux['tipo'] = $tarea->getTipoTarea()->getId();
            $tareaAux['ejecutada'] = $tarea->getStatus();
            $tareaAux['descripcion'] = $tarea->getDescripcion();
            if(($tareaAux['tipo'] == 2) || ($tareaAux['tipo'] == 3) || ($tareaAux['tipo'] == 4) ){
                $documentos = array();
                $documentosRelacionados = $this->em->getRepository('ProcesoBundle:Documento')
                ->findBy(array('actividades_sol' => $id));
                foreach ($documentosRelacionados as $documento) {
                    $docAux['nombre'] = $documento->getName();
                    $docAux['path'] = $documento-> getPath();
                    array_push($documentos, $docAux);
                }
                $tareaAux['documentos'] = $documentos;
            }else{
                if($tarea->getStatus() == true){
                    if($tarea->getDocumento() != null){
                        $tareaAux['filePath'] = $tarea->getDocumento()->getPath();
                        $tareaAux['fileName'] = $tarea->getDocumento()->getName();
                        $tareaAux['fileId'] = $tarea->getDocumento()->getId();
                    }
                }
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
            $notificaciones = $actividad->getNotificaciones();
            foreach ($notificaciones as $notificacion) {
                $notificacion->setTerminada(true);
            }
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
                $fecha = new \DateTime();
                $actividadSig->setFechaActivacion($fecha);
                if($actividadSig->getSolicitante()!=null)
                {
                    $this->generarNotificacion($actividadSig->getSolicitante(),1,$actividadSig);
                }
                else{
                //     $users = $this->em->getRepository('ProcesoBundle:PerfilResponsable')
                // ->findBy(array('responsable' => $actividadSig->getResponsable()->getId()));
                    $users = $actividadSig->getResponsable()->getUsers();

                    foreach ($users as $user) {
                        $this->generarNotificacion($user,1,$actividadSig);
                    }
                }


                $this->em->persist($actividadSig);

            }else{
                $actividad->getSolicitud()->setStatus(true);
                $user = $actividad->getSolicitud()->getSolicitante();
                $this->generarNotificacion($user, 3, $actividad->getSolicitud()->getProceso()->getNombre());
            }
            $actividad->setActiva(false);
            $this->em->persist($tarea);
            $this->em->flush();
            return true;     
        }
    }

    public function devolverActividadSolicitada($id, $mensaje){
        $actividad = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->find($id);
        $actividadAnt = $actividad->getActAnt();
        $actividad->setActiva(false);
        $actividadAnt->setActiva(true);
        $actividadAnt->setMensajeDevulucion($mensaje);
        if($actividadAnt->getSolicitante()!=null)
        {
            $this->generarNotificacion($actividadAnt->getSolicitante(),4,$actividadAnt);
        }
        else{
        //     $users = $this->em->getRepository('ProcesoBundle:PerfilResponsable')
        // ->findBy(array('responsable' => $actividadSig->getResponsable()->getId()));
            $users = $actividadAnt->getResponsable()->getUsers();

            foreach ($users as $user) {
                $this->generarNotificacion($user,4,$actividadAnt);
            }
        }
        $this->em->persist($actividad);
        $this->em->persist($actividadAnt);
        $this->em->flush();
        return true;
    }

    public function generarNotificacion($user, $tipoNotificacion, $actividad){

        $notificacion = new ENotificacion();
        $notificacion->setFecha(new \DateTime);
        $notificacion->setReceptor($user);
        $notificacion->setTipo($tipoNotificacion);
        $notificacion->getVisto(false);

        if($tipoNotificacion != 3)
        {   
            $notificacion->setActividad($actividad);
            $nombreActividad = $actividad->getNombre();
            $idActividad = $actividad->getId();
            $nombreProceso = $actividad->getSolicitud()->getProceso()->getNombre();

            if($tipoNotificacion == 1){
                $notificacion->setMensaje("Nueva actividad ".$nombreActividad.
                    " proviniente del proceso".$nombreProceso);
            }else if($tipoNotificacion == 2){
                $actividad->setNotificacionVencida(true);
                $this->em->persist($actividad);
                $notificacion->setMensaje("Parece que la actividad #".$idActividad." ".$nombreActividad.
                    " proviniente del proceso ".$nombreProceso." tiene el tiempo de ejecución VENCIDO");
            }else if($tipoNotificacion == 4){
                $notificacion->setMensaje("Parece que la actividad ".$nombreActividad." # ".$idActividad."ha sido devuelta"
                    );
            }
        }else{
              $notificacion->setMensaje("Proceso ".$actividad." terminado exitosamente"); 
        }
        $this->em->persist($notificacion);
        $this->em->flush();

    }

    public function getNotificacionesAlertas($userId){
        global $kernel;
        $container = $kernel->getcontainer();
        // dump($container->get('session'));
        // dump("")

        $notificaciones = $this->em->getRepository('ProcesoBundle:Notificaciones')
                ->findBy(array('receptor' => $userId, 'visto' => false, "tipo"  => 2, "terminada" => false));

        $getNotificaciones = array();

        foreach ($notificaciones as $notificacion) {

            $notificacionAux = array();
            $notificacionAux['mensaje'] = $notificacion->getMensaje();
            $notificacionAux['idActividad'] = $notificacion->getActividad()->getId();
            //agreagar el id de la actividad
            array_push($getNotificaciones, $notificacionAux);
        }
        //return $notificaciones;
        $container->get('session')->set("notificationesAlertas", $getNotificaciones);

    }

    public function getNotificacionesNormales($userId){
        global $kernel;
        $container = $kernel->getcontainer();
        // dump($container->get('session'));
        // dump("")

        $notificaciones = $this->em->getRepository('ProcesoBundle:Notificaciones')
                ->findBy(array('receptor' => $userId, 'visto' => false, "tipo"  => 4, "terminada" => false));
        //Modificar para que tambien traiga 3
        $getNotificaciones = array();

        foreach ($notificaciones as $notificacion) {

            $notificacionAux = array();
            $notificacionAux['mensaje'] = $notificacion->getMensaje();
            if($notificacion->getTipo()==1)
            {
                $notificacionAux['idActividad'] = $notificacion->getActividad()->getId();
            }
            //agreagar el id de la actividad
            array_push($getNotificaciones, $notificacionAux);
        }
        //return $notificaciones;
        $container->get('session')->set("notificationesNormales", $getNotificaciones);

    }

    public function limpiarNotificaciones($user, $tipo){

        $notificaciones = $user->getNotificaciones();

        foreach ($notificaciones as $notificacion) {

            if($notificacion->getTipo()==$tipo)
            {
                $notificacion->setVisto(true);
                 $this->em->persist($notificacion);
                 $this->em->flush();

            }
        }  
    }
    
    public function listarNotificaciones($user, $tipo){

        $notificaciones = $user->getNotificaciones();
        $response = array();
        foreach ($notificaciones as $notificacion) {
            if($notificacion->getTipo()==$tipo && $notificacion->getTerminada()==false)
            {
                $noti = array();
                $noti['id'] =$notificacion->getId();
                $noti['mensaje'] = $notificacion->getMensaje();
                $noti['nombreActividad'] = $notificacion->getActividad()->getNombre();
                $noti['fecha'] = $notificacion->getFecha();
                array_push($response, $noti);
            }
        }

        return $response;
    }

    public function actTerminadas($user){
        
        $response = array();
        $responsabilidades = $user->getResponsabilidades();
        foreach ($responsabilidades as $responsabilidad) {
            $actividades = $responsabilidad->getActividadesSolicitadas();
            foreach ($actividades as $actividad) {
                if($actividad->getStatus()==true){
                    $actiAux = array();
                    $actiAux['id'] = $actividad->getId();
                    $actiAux['nombre'] = $actividad->getNombre();
                    $actiAux['descripcion'] = $actividad->getDescripcion();
                    $actiAux['nombreProceso'] = $actividad->getSolicitud()->getProceso()->getNombre();
                    $actiAux['resposable_por'] = $actividad->getResponsable()->getNombre();
                    array_push($response, $actiAux);
                }
            }
        }
        return $response;
    }




}
