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

class ExpertController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('ProcesoBundle:All:Especialista:welcome.html.twig');
    }
    public function addProcessAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $id = $this->get('InformationService')->insertProcess($data);
            $response = new JsonResponse();
            $response->setData(array(
            'Insertado proceso' => 200,
            'id' => $id));
            return $response;
        }else{   
            $response = $this->get('InformationService')->getInformationProcess();
            return $this->render('ProcesoBundle:All:Especialista/addprocess.html.twig',  array(
                    'information' =>  json_encode($response)
                ));
            }
    }
    public function listProcessActiveAction()
    {
        $response = $this->get('InformationService')->listProcessActive();
        return $this->render('ProcesoBundle:All:Especialista/listProcessAct.html.twig',  array(
                    'processActive' =>  json_encode($response)
                ));
    }
    public function listProcessInactiveAction()
    {
        $response = $this->get('InformationService')->listProcessInactive();
        return $this->render('ProcesoBundle:All:Especialista/listProcessInactive.html.twig',  array(
                        'processInactive' =>  json_encode($response)
                    ));
    }
    public function listTaskAction()
    {
        $response = $this->get('InformationService')->getListTasks();
        return $this->render('ProcesoBundle:All:Especialista/listTask.html.twig',  array(
                'task' =>  json_encode($response)
            ));
    }
    public function listResponsibleAction()
    {
        $response = $this->get('InformationService')->getListResponsibles();
        return $this->render('ProcesoBundle:All:Especialista/listResponsible.html.twig', array(
                'responsible' =>  json_encode($response)
            ));
    }
    public function editProcessAction($id)
    {
        $response = $this->get('InformationService')->getProcess($id);
        return $this->render('ProcesoBundle:All:Especialista/editProcess.html.twig', array(
                'process' =>  json_encode($response)
            ));

    }

    public function activityRelationshipAction($id){
        $response = $this->get('InformationService')->listActivity($id);
        return $this->render('ProcesoBundle:All:Especialista/activityRelationship.html.twig', array(
                'listActivity' =>  json_encode($response)
            ));
    }
    public function renderViewsAction()
    {
        $user = $this->getUser();
        
        if($this->isGranted('ROLE_ESPECIALISTA_READ') || 
        $this->isGranted('ROLE_ESPECIALISTA_UPDATE') ||
        $this->isGranted('ROLE_ESPECIALISTA_CREATE_ALL')){
            return $this->redirectToRoute('_expertAddprocess');
        }else if($this->isGranted('ROLE_SOLICITANTE')){
            return $this->redirectToRoute('tatiSoft_soli_solicitante');
        }else if($this->isGranted('ROLE_RESPONSABLE_UPDATE')){
            return $this->redirectToRoute('_tatiSoft_resp_list');
        }

        return null;
    }

    public function holaSolicitanteAction()
    {
        return $this->render('ProcesoBundle:All:Solicitante/solicitante.html.twig');

    }

    public function addActivityAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $this->get('InformationService')->insertActivity($data);
        }

        $response = new JsonResponse();
            $response->setData(array(
            'Insertado proceso' => 200));

        return $response;
    }
}
