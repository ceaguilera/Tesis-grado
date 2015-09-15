<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('ProcesoBundle:All:listTask.html.twig');
    }
    public function listRolesAction()
    {
        return $this->render('ProcesoBundle:All:listRoles.html.twig');
    }
}
