<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Tati\ProcesoBundle\Entity\Responsable;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        }else{   
            $response = $this->get('InformationService')->getInformationProcess();
            return $this->render('ProcesoBundle:All:addprocess.html.twig',  array(
                    'information' =>  json_encode($response)
                ));
            }
    }
    public function listProcessActiveAction()
    {
        return $this->render('ProcesoBundle:All:listProcessAct.html.twig');
    }
    public function listProcessInactiveAction()
    {
        return $this->render('ProcesoBundle:All:listProcessInactive.html.twig');
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
}
