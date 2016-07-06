<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Tati\ProcesoBundle\Entity\Responsable as ERes;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use \DateTime;

class AutoridadController extends Controller
{

    public function listaProcesosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $solicitudes = $em->getRepository('ProcesoBundle:Solicitud')->findAll();
            $todoSolicitudes = array();
            $response = array();
            //var_dump($data['estado']);

            if(isset($data['fecha'])){
                $fecha = new \DateTime("".$data['fecha']);
                $data['fecha'] = $fecha->format('d-m-Y');
            }
            if(isset($data['estado'])){
                if($data['estado'] == "true")
                    $data['estado'] = true;
                else
                    $data['estado'] = false;
            }
            //var_dump($data['estado']);
            // var_dump($data['nombre']);
            // var_dump($data['solicitante']);
            // var_dump($data['responsable']);
            // var_dump($data['estado']);
            // var_dump($data['fecha']);

            foreach ($solicitudes as  $solicitud) {
                $sol = array();
                $sol['id'] = $solicitud->getId();
                $sol['nombreProceso'] = $solicitud->getProceso()->getNombre();
                $sol['solicitante'] = $solicitud->getSolicitante()->getNombre();
                $sol['usuario'] = $solicitud->getSolicitante()->getuserName();
                $sol['fechaSolicitud'] = $solicitud->getFecha()->format('d-m-Y');
                $sol['status'] = $solicitud->getStatus();
                $actividades = $solicitud->getActividades();
                foreach ($actividades as $actividad) {
                    if($actividad->getActiva()== true)
                        $sol['responsableActual'] = $actividad->getResponsable()->getNombre();
                    else
                        $sol['responsableActual'] = null;
                } 
                array_push($todoSolicitudes, $sol);

            }

            //filtro  00000

            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    
                    $response = $todoSolicitudes;
            }

            //filtro 00001
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }


            //filtro 00010
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00011
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00100
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00101
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00110
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00111
            if(!isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01000
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01001
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01010
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01011
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                             $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01100
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01101
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01110
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01111
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'] && 
                              $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01111
            if(!isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'] && 
                              $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10000
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10001
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10010
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10011
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10100
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10101
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10110
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10111
            if(isset($data['nombre']) && 
                !isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11000
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11001
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11010
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11011
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11100
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&$solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11101
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11110
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11111
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                isset($data['solicitante']) &&
                isset($data['fecha']) &&
                isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            $datos = new JsonResponse($response, 200);
            return $datos;

            ///var_dump("paso por aqui");
        }else{
            $solicitudes = $em->getRepository('ProcesoBundle:Solicitud')->findAll();

            $response = array();
            foreach($solicitudes as $solicitud){
                $sol = array();
                $sol['id'] = $solicitud->getId();
                $sol['nombreProceso'] = $solicitud->getProceso()->getNombre();
                $sol['solicitante'] = $solicitud->getSolicitante()->getNombre();
                $sol['usuario'] = $solicitud->getSolicitante()->getuserName();
                $sol['fechaSolicitud'] = $solicitud->getFecha()->format('d-m-Y');
                $sol['status'] = $solicitud->getStatus();
                $actividades = $solicitud->getActividades();
                foreach ($actividades as $actividad) {
                    if($actividad->getActiva()== true)
                        $sol['responsableActual'] = $actividad->getResponsable()->getNombre();
                    else
                        $sol['responsableActual'] = null;
                }

                array_push($response, $sol);
            }
            $responsable = $this->get('InformationService')->getListResponsibles();
            return $this->render('ProcesoBundle:All:Autoridad/listaProcesos.html.twig', array(
                    'data' =>  json_encode($response),
                    'responsables' => json_encode($responsable)
                ));
        }
    }

    public function pdfAction(Request $request){
        $data = $request->request->all();
        dump($data);
        dump(empty($data['nombre']));

        $em = $this->getDoctrine()->getManager();
        $solicitudes = $em->getRepository('ProcesoBundle:Solicitud')->findAll();
        $todoSolicitudes = array();
        $response = array();
        foreach ($solicitudes as  $solicitud) {
            $sol = array();
            $sol['id'] = $solicitud->getId();
            $sol['nombreProceso'] = $solicitud->getProceso()->getNombre();
            $sol['solicitante'] = $solicitud->getSolicitante()->getNombre();
            $sol['usuario'] = $solicitud->getSolicitante()->getuserName();
            $sol['fechaSolicitud'] = $solicitud->getFecha()->format('d-m-Y');
            $sol['status'] = $solicitud->getStatus();
            $actividades = $solicitud->getActividades();
            foreach ($actividades as $actividad) {
                if($actividad->getActiva()== true)
                    $sol['responsableActual'] = $actividad->getResponsable()->getNombre();
                else
                    $sol['responsableActual'] = null;
            } 
            array_push($todoSolicitudes, $sol);

        }

            //filtro  00000
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    
                    $response = $todoSolicitudes;
            }

            //filtro 00001
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }


            //filtro 00010
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00011
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00100
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00101
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00110
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 00111
            if(empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01000
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01001
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01010
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01011
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                             $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01100
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01101
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01110
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01111
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'] && 
                              $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 01111
            if(empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                             $solicitud['fechaSolicitud'] == $data['fecha'] && 
                              $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10000
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                dump("entro");
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10001
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10010
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10011
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10100
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10101
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10110
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 10111
            if(!empty($data['nombre']) && 
                empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['solicitante'] == $data['solicitante'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11000
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11001
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11010
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11011
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['fechaSolicitud'] == $data['fecha'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11100
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&$solicitud['solicitante'] == $data['solicitante'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11101
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11110
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

            //filtro 11111
            if(!empty($data['nombre']) && 
                !empty($data['responsable']) &&
                !empty($data['solicitante']) &&
                !empty($data['fecha']) &&
                !empty($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && 
                            $solicitud['responsableActual'] == $data['responsable'] &&
                            $solicitud['solicitante'] == $data['solicitante'] && 
                            $solicitud['fechaSolicitud'] == $data['fecha'] &&
                            $solicitud['status'] == $data['estado'])
                        {  
                            array_push($response, $solicitud);
                        }
                    }
            }

      $dompdf = $this->get('slik_dompdf');

    // Generate the pdf
        $dompdf->getpdf($this->renderView('ProcesoBundle:All:Autoridad/pdfListaSolicitudes.html.twig', array(
                    'data' =>  $response,
                )));

    // Either stream the pdf to the browser
        $dompdf->stream("lista_de_solicitudes.pdf");

    // Or get the output to handle it yourself
        // $pdfoutput = $dompdf->output();
        // return new Response($pdfoutput, 200, array('Content-Type' => 'application/pdf'));

        // dump(get_class_methods($dompdf));
        //  return $this->render('ProcesoBundle:All:Autoridad/pdfListaSolicitudes.html.twig', array(
        //             'data' =>  $response
        //         ));

    }
}
