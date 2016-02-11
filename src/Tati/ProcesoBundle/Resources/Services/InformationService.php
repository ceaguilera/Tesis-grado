<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\Proceso as EProceso;
use Tati\ProcesoBundle\Entity\Actividad as EActividad;
use Tati\ProcesoBundle\Entity\Tarea as ETarea;
use Tati\ProcesoBundle\Entity\TipoTarea as ETipoTarea;

class InformationService
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

	public function getInformationProcess(){

		$task = $this->em->getRepository('ProcesoBundle:TipoTarea')->findAll(); 
		$role = $this->em->getRepository('ProcesoBundle:Responsable')->findAll();       
        $response['tareas'] = array();
        $response['responsables'] = array();

        foreach($task as $valor){
            $task2 = array();
            $task2['id'] = $valor->getId();
            $task2['nombre'] = $valor->getNombre();
            array_push($response['tareas'], $task2);
        }
        foreach($role as $valor){
            $role2 = array();
            $role2['id'] = $valor->getId();
            $role2['nombre'] = $valor->getNombre();
            array_push($response['responsables'], $role2);
        }

        return $response;
	}

	public function getListTasks(){

		$task = $this->em->getRepository('ProcesoBundle:TipoTarea')->findAll(); 
		$response = array();      

        foreach($task as $valor){
            $task2 = array();
            $task2['id'] = $valor->getId();
            $task2['nombre'] = $valor->getNombre();
            $task2['descripcion'] = $valor->getDescripcion();
            array_push($response, $task2);
        }
        return $response;
	}

	public function getListResponsibles(){

		$responsible = $this->em->getRepository('ProcesoBundle:Responsable')->findAll();       
        $response = array();

        foreach($responsible as $valor){
            $responsible2 = array();
            $responsible2['id'] = $valor->getId();
            $responsible2['nombre'] = $valor->getNombre();
            array_push($response, $responsible2);
        }

        return $response;
	}

    public function insertProcess($data){

        $proceso = new EProceso();
        $proceso->setProceso($data);
        foreach ($data['actividades'] as $dataActividad) {
            $responsable = $this->em->getRepository('ProcesoBundle:Responsable')->find($dataActividad['idResponsable']);
            $actividad = new EActividad;
            $actividad->setActividad($dataActividad);
            foreach ($dataActividad['tareas'] as $dataTarea) {
                $tarea = new ETarea();
                $tarea->setTarea($dataTarea);
                $tipoTarea = $this->em->getRepository('ProcesoBundle:TipoTarea')->find($dataTarea['tipo']);
                $tarea->setTipoTarea($tipoTarea);
                $tipoTarea->addTarea($tarea);

                $actividad->addTarea($tarea);
                $tarea->setActividades($actividad);
            }
            $actividad-> setIdResponsable($responsable);
            $actividad->setProceso($proceso);
            $proceso->addActividade($actividad);
        }
        $this->em->persist($proceso);
        $this->em->flush();
    }

    public function listProcessActive(){
        $procesos = $this->em->getRepository('ProcesoBundle:Proceso')->findBy(array(
        'status' => true));
        $response = array();
        foreach ($procesos as $valor) {
            $response2 = array();
            $response2['id']=$valor->getId();
            $response2['nombre'] = $valor->getNombre();
            $response2['numActividades'] = count($valor->getActividades());
            array_push($response, $response2);
        }

        return $response;

    }

    public function listProcessInactive(){
        $procesos = $this->em->getRepository('ProcesoBundle:Proceso')->findBy(array(
        'status' => false));
        $response = array();
        foreach ($procesos as $valor) {
            $response2 = array();
            $response2['id']=$valor->getId();
            $response2['nombre'] = $valor->getNombre();
            $response2['numActividades'] = count($valor->getActividades());
            array_push($response, $response2);
        }

        return $response;

    }

    public function getProcess($id){
        $proceso = $this->em->getRepository('ProcesoBundle:Proceso')->find($id);
        //$response = $proceso->getNombre();
        //print($response);
        $response = array();
            $response['nombre'] = $proceso->getNombre();
            $response['actividades'] = array();
            $actividades = $proceso->getActividades();
            foreach ($actividades as $actividadesP) {
                $actividad = array();
                $actividad['nombre'] = $actividadesP->getNombre();
                $actividad['idActSig'] = $actividadesP->getIdActSig();
                $actividad['idActAn'] = $actividadesP->getIdActAnt();
                $actividad['tiempo'] = $actividadesP->getTiempo();
                $actividad['descripcion'] = $actividadesP->getDescripcion();
                $actividad['responsable'] = $actividadesP->getIdResponsable()->getId();
                $actividad['tareas']= array();
                $tareas = $actividadesP->getTareas();
                foreach ($tareas as $tareasP) {
                    $tarea['nombre'] = $tareasP->getNombre();
                    $tarea['descripcion'] = $tareasP->getDescripcion();
                    $tarea['tipo'] = $tareasP->getTipoTarea()->getId();
                    array_push($actividad['tareas'], $tarea);
                }
                array_push($response['actividades'], $actividad);
            }
        return $response;
        }
}
