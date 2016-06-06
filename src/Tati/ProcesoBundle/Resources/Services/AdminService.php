<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\User as EUser;
use Tati\ProcesoBundle\Entity\Departamento as EDep;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUni;
use Tati\ProcesoBundle\Entity\PerfilSolicitante as EPS;

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
    public function registro($data){
        if($data['tipo'] == 1){
            $user = new EUser();
            $user->setUsername($data['datos']['correo']);
            $user->setEmail($data['datos']['correo']);
            $user->setPlainPassword($data['datos']['password']);
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

            $this->em->persist($user);
            $this->em->flush();
        }

    }



}
