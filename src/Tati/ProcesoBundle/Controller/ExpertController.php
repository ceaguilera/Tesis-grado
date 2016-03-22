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
        return $this->render('ProcesoBundle:All:welcome.html.twig');
    }
    public function addProcessAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $this->get('InformationService')->insertProcess($data);
            $response = new JsonResponse();
            $response->setData(array(
            'Insertado proceso' => 200));
            return $response;
        }else{   
            $response = $this->get('InformationService')->getInformationProcess();
            return $this->render('ProcesoBundle:All:addprocess.html.twig',  array(
                    'information' =>  json_encode($response)
                ));
            }
    }
    public function listProcessActiveAction()
    {
        $response = $this->get('InformationService')->listProcessActive();
        return $this->render('ProcesoBundle:All:listProcessAct.html.twig',  array(
                    'processActive' =>  json_encode($response)
                ));
    }
    public function listProcessInactiveAction()
    {
        $response = $this->get('InformationService')->listProcessInactive();
        return $this->render('ProcesoBundle:All:listProcessInactive.html.twig',  array(
                        'processInactive' =>  json_encode($response)
                    ));
    }
    public function listTaskAction()
    {
        $response = $this->get('InformationService')->getListTasks();
        return $this->render('ProcesoBundle:All:listTask.html.twig',  array(
                'task' =>  json_encode($response)
            ));
    }
    public function listResponsibleAction()
    {
        $response = $this->get('InformationService')->getListResponsibles();
        return $this->render('ProcesoBundle:All:listResponsible.html.twig', array(
                'responsible' =>  json_encode($response)
            ));
    }
    public function editProcessAction($id)
    {
        $response = $this->get('InformationService')->getProcess($id);
        return $this->render('ProcesoBundle:All:editProcess.html.twig', array(
                'process' =>  json_encode($response)
            ));

    }
    public function renderViewsAction()
    {
        $user = $this->getUser();
        
        if($this->isGranted('ROLE_ESPECIALISTA')){

            
            return $this->redirectToRoute('_expertAddprocess');
        }

        return null;
    }
}
