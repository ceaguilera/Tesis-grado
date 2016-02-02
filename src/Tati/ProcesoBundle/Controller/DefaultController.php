<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Tati\ProcesoBundle\Entity\Responsable;
use Doctrine\ORM\EntityRepository;

class DefaultController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('ProcesoBundle:All:welcome.html.twig');
    }
    public function addProcessAction()
    {
        $task = $this->getDoctrine()->getRepository('ProcesoBundle:Tarea')->findAll();        
        $response = array();

        foreach($task as $valor){
            $task2 = array();
            $task2['id'] = $valor->getId();
            $task2['nombre'] = $valor->getNombre();
            $task2['descripcion'] = $valor->getDescripcion();
            array_push($response, $task2);
        }
        return $this->render('ProcesoBundle:All:addprocess.html.twig',  array(
                'task' =>  json_encode($response)
            ));
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
        // foreach ($task as $valor){
        //     print($valor->getid());
        //     print($valor->getnombre());
        //     print($valor->getslug());
        // }
        
        $response = array();

        foreach($task as $valor){
            $task2 = array();
            $task2['id'] = $valor->getId();
            $task2['nombre'] = $valor->getNombre();
            $task2['descripcion'] = $valor->getDescripcion();
            array_push($response, $task2);
        }

        return $this->render('ProcesoBundle:All:listTask.html.twig',  array(
                'task' =>  json_encode($response)
            ));
    }
    public function listRolesAction()
    {
         $role = $this->getDoctrine()->getRepository('ProcesoBundle:Responsable')->findAll();
        // foreach ($task as $valor){
        //     print($valor->getid());
        //     print($valor->getnombre());
        //     print($valor->getslug());
        // }
        
        $response = array();

        foreach($role as $valor){
            $role2 = array();
            $role2['id'] = $valor->getId();
            $role2['nombre'] = $valor->getNombre();
            array_push($response, $role2);
        }
        return $this->render('ProcesoBundle:All:listRoles.html.twig', array(
                'task' =>  json_encode($response)
            ));
    }
}
