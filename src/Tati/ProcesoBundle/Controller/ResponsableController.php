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
        return $this->render('ProcesoBundle:All:Responsable/actividadesPendientes.html.twig');
    }

    public function endActivitiesAction(){
        return $this->render('ProcesoBundle:All:Responsable/actividadesTerminadas.html.twig');
    }

    public function fileAction(){
        return $this->render('ProcesoBundle:All:Responsable/archivos.html.twig');
    }

    public function alertAction(){
        return $this->render('ProcesoBundle:All:Responsable/alertas.html.twig');
    }
}
