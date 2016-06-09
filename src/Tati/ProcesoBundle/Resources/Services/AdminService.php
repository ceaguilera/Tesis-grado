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

        $user = $this->em->getRepository('ProcesoBundle:User')->find(1);
        $users = $this->em->getRepository('ProcesoBundle:User')->findAll();         
        $response = array();
        dump(get_class_methods($user));
        foreach($users as $user){
            $usuario = array();
            $usuario['id'] = $user->getId();
            $usuario['userName'] = $user->getUsername();
            $usuario['email'] = $user->getEmail();
            $usuario['rol'] = $user->getRoles()[0];
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
        $user = new EUser();
        $user->setUsername($data['datos']['correo']);
        $user->setEmail($data['datos']['correo']);
        $user->setPlainPassword($data['datos']['password']);
        if($data['tipo'] == 1){
            $role = array("ROLE_SOLICITANTE");
            $user->setRoles($role);
            $user->setEnabled(true);
            //Revisar esto DETAIL: Ya existe la llave (departamento_id)=(1).
            $perfilSolicitante = new EPS();
            $perfilSolicitante->setNombre($data['datos']['nombre']);
            //$perfilSolicitante->setCedula($data['datos']['cedula']);
            $departamento = $this->em->getRepository('ProcesoBundle:Departamento')->find($data['datos']['departamento']);
            $perfilSolicitante->setDepartamento($departamento);
            $unidad = $this->em->getRepository('ProcesoBundle:UnidadAcademica')->find($data['datos']['unidad']);
            $perfilSolicitante->setUnidadAcademcia($unidad);
            $perfilSolicitante->setUser($user);
            $user->setPerfilSolicitante($perfilSolicitante);

        }else if($data['tipo'] == 2){
            if($data['datos']['permiso']== 1){
                $role = array("ROLE_RESPONSABLE_READ");
            }else{
                $role = array("ROLE_RESPONSABLE_UPDATE");
            }
            $user->setRoles($role);
            $user->setEnabled(true);
            $perfilResponsable = new EPR();
            $perfilResponsable->setNombre($data['datos']['nombre']);
            $perfilResponsable->setCargo($data['datos']['cargo']);
            if($data['datos']['tipoResponsable'] == 1){
                $responsable = new EResponsanble();
                $responsable->setNombre($data['datos']['responsable']);
                $this->em->persist($responsable);
            }else{
                $responsable = $this->em->getRepository('ProcesoBundle:Responsable')->find($data['datos']['responsable']);
            }
            $perfilResponsable->setTipoResponsable($responsable);
            $departamento = $this->em->getRepository('ProcesoBundle:Departamento')->find($data['datos']['departamento']);
            $perfilResponsable->setDepartamento($departamento);
            $unidad = $this->em->getRepository('ProcesoBundle:UnidadAcademica')->find($data['datos']['unidad']);
            $perfilResponsable->setUnidadAcademcia($unidad);
            $perfilResponsable->setUser($user);
            $user->setPerfilResponsable($perfilResponsable);
        }
        $this->em->persist($user);
        $this->em->flush();

    }



}
