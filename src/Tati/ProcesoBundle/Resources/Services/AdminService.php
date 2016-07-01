<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\User as EUser;
use Tati\ProcesoBundle\Entity\Departamento as EDep;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUni;
use Tati\ProcesoBundle\Entity\PerfilSolicitante as EPS;
use Tati\ProcesoBundle\Entity\PerfilResponsable as EPR;
use Tati\ProcesoBundle\Entity\Responsable as EResponsanble;

class AdminService
{
	private $em;
	/**
     * Constructor del servicio
     *
     */
    public function __construct($em)
    {
        $this->em= $em;
    }

    public function getListUsers(){

        //$user = $this->em->getRepository('ProcesoBundle:User')->find(1);
        $users = $this->em->getRepository('ProcesoBundle:User')->findAll();         
        $response = array();
        //dump(get_class_methods($user));
        foreach($users as $user){
            $usuario = array();
            $usuario['id'] = $user->getId();
            $usuario['userName'] = $user->getUserName();
            $usuario['email'] = $user->getEmail();
            $usuario['rol'] = $user->getRoles();
            $usuario['lastLogin'] = $user->getLastLogin();
            array_push($response, $usuario);
        }

        return $response;
    }

    public function getListDepartament(){

        $departamentos = $this->em->getRepository('ProcesoBundle:Departamento')->findAll();
        $response = array();
        foreach($departamentos as $departamento){
            $dep = array();
            $dep['id'] = $departamento->getId();
            $dep['nombre'] = $departamento->getNombre();
            array_push($response, $dep);
        }

        return $response;
    }

    public function getUnidadesAcademicas($data){
        $unidades = $this->em->getRepository('ProcesoBundle:UnidadAcademica')->findBy(array('departamento' => $data['departamentoId']));
        $response = array();
        foreach($unidades as $unidad){
            $uni = array();
            $uni['id'] = $unidad->getId();
            $uni['nombre'] = $unidad->getNombre();
            array_push($response, $uni);
        }

        return $response;
    }

    public function getTiposResposables(){
        $responsables = $this->em->getRepository('ProcesoBundle:Responsable')->findAll();
        $response = array();
        foreach($responsables as $responsable){
            $resp = array();
            $resp['id'] = $responsable->getId();
            $resp['nombre'] = $responsable->getNombre();
            array_push($response, $resp);
        }

        return $response;
    }

    public function registro($data){

        if(!isset($data['id'])){
            $user = new EUser();
            $user->setUsername($data['datos']['correo']);
            $user->setEmail($data['datos']['correo']);
            $user->setPlainPassword($data['datos']['cedula']);
            $user->setNombre($data['datos']['nombre']);
            $departamento = $this->em->getRepository('ProcesoBundle:Departamento')->find($data['datos']['departamento']);
            $user->setDepartamento($departamento);
            $unidad = $this->em->getRepository('ProcesoBundle:UnidadAcademica')->find($data['datos']['unidad']);
            $user->setUnidadAcademcia($unidad);
            $user->setCedula($data['datos']['cedula']);
            $user->setEnabled(true);
            if(isset($data['datos']['responsabilidades'])){
                if($data['datos']['esEspecialista']==1 ){
                    $role = array("ROLE_SOLICITANTE", "ROLE_RESPONSABLE_UPDATE", "ROLE_ESPECIALISTA_CREATE_ALL");
                }else{
                    $role = array("ROLE_SOLICITANTE", "ROLE_RESPONSABLE_UPDATE");
                }
                $user->setRoles($role);
                foreach ($data['datos']['responsabilidades'] as $resposabilidad) {
                    $responsable  = $this->em->getRepository('ProcesoBundle:Responsable')->find($resposabilidad['id']);
                    $user->addResponsabilidade($responsable);
                }
            }else{
                if($data['datos']['esEspecialista']==1 ){
                    $role = array("ROLE_SOLICITANTE", "ROLE_ESPECIALISTA_CREATE_ALL");
                }else{
                    $role = array("ROLE_SOLICITANTE");
                }
                $user->setRoles($role);
            }

        }else{
            $user = $this->em->getRepository('ProcesoBundle:User')->find($data['id']);
            $user->setUsername($data['datos']['correo']);
            $user->setEmail($data['datos']['correo']);
            $user->setPlainPassword($data['datos']['cedula']);
            $user->setNombre($data['datos']['nombre']);
            $departamento = $this->em->getRepository('ProcesoBundle:Departamento')->find($data['datos']['departamento']);
            $user->setDepartamento($departamento);
            $unidad = $this->em->getRepository('ProcesoBundle:UnidadAcademica')->find($data['datos']['unidad']);
            $user->setUnidadAcademcia($unidad);
            $user->setCedula($data['datos']['cedula']);
            $user->setEnabled(true);
            if(isset($data['datos']['responsabilidades'])){
                if($data['datos']['esEspecialista']==1 ){
                    $role = array("ROLE_SOLICITANTE", "ROLE_RESPONSABLE_UPDATE", "ROLE_ESPECIALISTA_CREATE_ALL");
                }else{
                    $role = array("ROLE_SOLICITANTE", "ROLE_RESPONSABLE_UPDATE");
                }
                $user->setRoles($role);
                $responsabilidades = getResponsabilidades();
                foreach ($responsabilidades as $resposabilidad) {
                    $user->removeResponsabilidade($resposabilidad);
                }
                foreach ($data['datos']['responsabilidades'] as $resposabilidad) {
                    $responsable  = $this->em->getRepository('ProcesoBundle:Responsable')->find($resposabilidad['id']);
                    $user->addResponsabilidade($responsable);
                }
            }else{
                $responsabilidades = getResponsabilidades();
                foreach ($responsabilidades as $resposabilidad) {
                    $user->removeResponsabilidade($resposabilidad);
                }
                if($data['datos']['esEspecialista']==1 ){
                    $role = array("ROLE_SOLICITANTE", "ROLE_ESPECIALISTA_CREATE_ALL");
                }else{
                    $role = array("ROLE_SOLICITANTE");
                }
                $user->setRoles($role);
            }
        }
        $this->em->persist($user);
        $this->em->flush();

    }



}
