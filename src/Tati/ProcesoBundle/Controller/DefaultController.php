<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Doctrine\ORM\EntityRepository;

class DefaultController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('ProcesoBundle:All:welcome.html.twig');
    }
    public function addProcessAction()
    {
        return $this->render('ProcesoBundle:All:addprocess.html.twig');
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

        $task = $this->getDoctrine()->getRepository('ProcesoBundle:Tarea')->findAll();
        foreach ($task as $valor){
            print($valor->getid());
            print($valor->getnombre());
            print($valor->getslug());
        }
        
        $response = array();

        foreach($task as $valor){
            $task2 = array();
            $task2['id'] = $valor->getId();
            array_push($response, $task2);
        }

        return $this->render('ProcesoBundle:All:listTask.html.twig',  array(
                'task' =>  json_encode($response)
            ));
    }
    public function listRolesAction()
    {
        return $this->render('ProcesoBundle:All:listRoles.html.twig');
    }
}
