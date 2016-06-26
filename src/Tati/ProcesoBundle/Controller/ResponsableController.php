<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Tati\ProcesoBundle\Entity\Responsable;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ResponsableController extends Controller
{
    public function pendingActivitiesAction(){
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        $this->get('GeneralService')->getNotificacionesNormales($this->getUser()->getId());
        $user = $this->getUser();
        if($user->getPerfilSolicitante()!=null)
                $nombre = $user->getPerfilSolicitante()->getNombre();
            else
                $nombre = $user->getPerfilResponsable()->getNombre();

        $this->get('session')->set("userNombre", $nombre);
        $responsable  = $this->getUser()->getPerfilResponsable()->getResponsable()->getId();
        $response = $this->get('ResponsableService')->listaActividadesSol($responsable);
        return $this->render('ProcesoBundle:All:Responsable/actividadesPendientes.html.twig', array(
                    'data' =>  json_encode($response)
                    
                ));
    }

    public function endActivitiesAction(){
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        return $this->render('ProcesoBundle:All:Responsable/actividadesTerminadas.html.twig');
    }

    public function fileAction(){
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        return $this->render('ProcesoBundle:All:Responsable/archivos.html.twig');
    }

    public function alertAction(){
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        return $this->render('ProcesoBundle:All:Responsable/alertas.html.twig');
    }

    public function getActividadAction($id){

            $response = $this->get('GeneralService')->getTareas($id);
            $response['nombreUser'] = $this->getUser()->getUserName();
            return $this->render('ProcesoBundle:All:Responsable/detalleActividad.html.twig',  array(
                    'data' =>  json_encode($response)
                ));
        
    }

    public function statusTareaAction(Request $request){

        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $response = $this->get('GeneralService')->setStatusTareasSolicitadas($data['idTarea']);
        }
         $response = new JsonResponse("cambio de status de tarea exitoso", 200);

         return $response;
    }

    public function ejecutarActividadAction(Request $request){

        if ($request->isXmlHttpRequest()){
            $data = json_decode($request->getContent(),true);
            $status = $this->get('GeneralService')->setStatusActividadSolicitada($data['idActividad']);
            if($status){
                $response = new JsonResponse("Actividad ejecuada correctamente", 200);
            }else{
                $response = new JsonResponse("Hubo un error, falta alguna tarea por ser ejecutada", 500);
            }
            return $response;
        }
    }

}
