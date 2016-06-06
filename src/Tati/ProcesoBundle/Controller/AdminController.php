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

class AdminController extends Controller
{
    public function listUsersAction(){
    	$response = $this->get('AdminService')->getListUsers();
        return $this->render('ProcesoBundle:All:Admin/listaUsuarios.html.twig',  array(
                    'users' =>  json_encode($response))
        );
    }
    public function addSolicitanteAction(){
    	$response = $this->get('AdminService')->getListDepartament();
        return $this->render('ProcesoBundle:All:Admin/agregarSolicitante.html.twig',  array(
                    'departament' =>  json_encode($response)));
    }
    public function addResponsableAction(){
        return $this->render('ProcesoBundle:All:Admin/agregarResponsable.html.twig');
    }
    public function addEspecialistaAction(){
        return $this->render('ProcesoBundle:All:Admin/agregarEspecialista.html.twig');
    }
    public function addAutoridadAction(){
        return $this->render('ProcesoBundle:All:Admin/agregarAutoridad.html.twig');
    }

    public function getUnidadesAction(Request $request){
    	if ($request->isXmlHttpRequest()) {
    		$data = json_decode($request->getContent(),true);
    		$unidades = $this->get('AdminService')->getUnidadesAcademicas($data);
            ///var_dump("paso por aqui");
    	}

    	$response = new JsonResponse($unidades, 200);
    	return $response;
    }

    public function registerAction(Request $request){
    	if ($request->isXmlHttpRequest()) {
    		$data = json_decode($request->getContent(),true);
    		$this->get('AdminService')->registro($data);
            ///var_dump("paso por aqui");
    	}

    	$response = new JsonResponse("Usuario registrado", 200);
    	return $response;
    }

}
