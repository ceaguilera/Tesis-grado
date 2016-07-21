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

class AdminController extends Controller
{

    public function listUsersAction(){
    	$response = $this->get('AdminService')->getListUsers();
        return $this->render('ProcesoBundle:All:Admin/listaUsuarios.html.twig',  array(
                    'users' =>  json_encode($response))
        );
    }
    public function addSolicitanteAction(){
    	$departamentos = $this->get('AdminService')->getListDepartament();
        $responsables = $this->get('AdminService')->getTiposResposables();
        $response = array();
        $response['departamentos'] = $departamentos;
        $response['responsables'] = $responsables;        
        return $this->render('ProcesoBundle:All:Admin/agregarSolicitante.html.twig',  array(
                    'departament' =>  json_encode($response)));
    }
    public function addResponsableAction(){
    	$departamentos = $this->get('AdminService')->getListDepartament();
    	$responsables = $this->get('AdminService')->getTiposResposables();
    	$response = array();
    	$response['departamentos'] = $departamentos;
    	$response['responsables'] = $responsables;
        return $this->render('ProcesoBundle:All:Admin/agregarResponsable.html.twig', array(
                    'data' =>  json_encode($response)));
    }
    public function addEspecialistaAction(){
        $response = $this->get('InformationService')->getListResponsibles();
        return $this->render('ProcesoBundle:All:Admin/listaResponsables.html.twig', array(
                'responsible' =>  json_encode($response)
            ));
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

    public function registerResponsableAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            $datos = json_decode($request->getContent(),true);
            
            foreach ($datos as $dato) {
                $responsible = new ERes();
                $responsible->setNombre($dato['nombre']);
                $em->persist($responsible);
                $em->flush();
            }
        }

        $response = new JsonResponse("Responsables Registrados", 200);
        return $response;
    }

    public function editarUsuarioAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ProcesoBundle:User')->find($id);
        $data = array();
        
        $data['nombre'] = $user->getNombre();
        $data['cedula'] = $user->getCedula();
        $data['correo'] = $user->getEmail();
        $data['departamento'] = $user->getDepartamento()->getId();
        $data['unidad'] = $user->getUnidadAcademcia()->getId();
        $roles = $user->getRoles();
        dump($roles);
        foreach ($roles as $key => $role) {
            dump($role);
            if($role == "ROLE_ESPECIALISTA_CREATE_ALL")
                $data['esEspecialista'] = true;

            if($role =="ROLE_RESPONSABLE_UPDATE"){
                $data['esResponsable'] = true;
                $data['responsabilidades'] = array();
                $responsabilidades = $user->getResponsabilidades();
                foreach ($responsabilidades as  $responabilidad) {
                    $responsa = array();
                    $responsa['id'] =  $responabilidad->getId();
                    array_push($data['responsabilidades'], $responsa);
                }
            }

            if($role =="ROLE_AUTORIDAD")
                $data['esAutoridad'] = true;
            
        }

        $departamentos = $this->get('AdminService')->getListDepartament();
        $responsables = $this->get('AdminService')->getTiposResposables();
        $response['departamentos'] = $departamentos;
        $response['responsables'] = $responsables;
        $response['datos'] = $data;
        return $this->render('ProcesoBundle:All:Admin/editUser.html.twig', array(
                    'data' =>  json_encode($response)
                ));


    }

}
