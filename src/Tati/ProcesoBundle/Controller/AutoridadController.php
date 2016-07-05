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
            if(isset($data['nombre']) && 
                isset($data['responsable']) &&
                !isset($data['solicitante']) &&
                !isset($data['fecha']) &&
                !isset($data['estado'])){
                    $solicitudFiltro = array();
                    foreach($todoSolicitudes as $solicitud){
                        if($solicitud['nombreProceso'] == $data['nombre'] && $solicitud['responsableActual']== $data['responsable'])
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

}
