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
        dump($response);
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

        if(is_null($data['id']))
        {
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
                $actividad->setResponsable($responsable);
                $actividad->setProceso($proceso);
                $proceso->addActividade($actividad);
            }
            $this->em->persist($proceso);
            $this->em->flush();
            return $proceso->getId();

        }else{
            //var_dump($data);
            $proceso = $this->em->getRepository('ProcesoBundle:Proceso')->find($data['id']);
            //Eliminando los datos
            foreach ($proceso->getActividades() as $actividad) 
            {
                foreach ($actividad->getTareas() as $tarea) 
                {
                    $tarea->setActividades(null);
                    $actividad->removeTarea($tarea);
                    $this->em->remove($tarea);
                }
                $actividad->setProceso(null);
                $actSig = $actividad->getActSig();
                $actAnt = $actividad->getActAnt();
                if(!is_null($actSig)){
                    $actSig->setActAnt(null);
                    $this->em->persist($actSig);
                }

                if(!is_null($actAnt)){
                    $actAnt->setActSig(null);
                    $this->em->persist($actAnt);
                }

                $this->em->flush();
                $actividad->setActSig(null);
                $actividad->setActAnt(null);
                $proceso->removeActividade($actividad);
                $this->em->remove($actividad);
            }
            $this->em->persist($proceso);
            $this->em->flush();


            $proceso->setProceso($data);

            foreach ($data['actividades'] as $dataActividad) 
            {
                $responsable = $this->em->getRepository('ProcesoBundle:Responsable')->find($dataActividad['idResponsable']);
                $actividad = new EActividad;
                $actividad->setActividad($dataActividad);
                foreach ($dataActividad['tareas'] as $dataTarea) 
                {
                    $tarea = new ETarea();
                    $tarea->setTarea($dataTarea);
                    $tipoTarea = $this->em->getRepository('ProcesoBundle:TipoTarea')->find($dataTarea['tipo']);
                    $tarea->setTipoTarea($tipoTarea);
                    $tipoTarea->addTarea($tarea);

                    $actividad->addTarea($tarea);
                    $tarea->setActividades($actividad);
                }
                $actividad-> setResponsable($responsable);
                $actividad->setProceso($proceso);
                $proceso->addActividade($actividad);
            }
            $this->em->persist($proceso);
            $this->em->flush();
        }
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
            $response['id'] = $proceso->getId();
            $response['descripcion'] = $proceso->getDescripcion();
            $response['actividades'] = array();
            $actividades = $proceso->getActividades();
            foreach ($actividades as $actividadesP) {
                $actividad = array();
                $actividad['nombre'] = $actividadesP->getNombre();
                //$actividad['idActSig'] = $actividadesP->getIdActSig();
                //$actividad['idActAnt'] = $actividadesP->getIdActAnt();
                $actividad['tiempo'] = $actividadesP->getTiempo();
                $actividad['descripcion'] = $actividadesP->getDescripcion();
                $actividad['idResponsable'] = $actividadesP->getResponsable()->getId();
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

    public function listActivity($id){
        $proceso = $this->em->getRepository('ProcesoBundle:Proceso')->find($id);

        $response = array();
        $response['actividades'] = array();
        $response['id'] = $id;

        $actividades = $proceso->getActividades();

        foreach ($actividades as $actividad) {
                $response2 = array();
                $response2['id'] = $actividad->getId();
                $response2['nombre'] = $actividad->getNombre();
                if($actividad->getActSig() == null)
                {
                    if($actividad->getInicioFin() == null)
                        $response2['actSig'] = -3;    
                    else
                        $response2['actSig'] = $actividad->getInicioFin();
                }else{
                    $response2['actSig'] = $actividad->getActSig()->getId();
                }
                if($actividad->getActAnt() == null)
                {
                    if($actividad->getInicioFin() == null)
                        $response2['actAnt'] = -3;    
                    else
                        $response2['actAnt'] = $actividad->getInicioFin();
                }else{
                    $response2['actAnt'] = $actividad->getActAnt()->getId();
                }
                
                array_push($response['actividades'], $response2);
        }
        return $response;
    }

    public function insertActivity($data){
        //var_dump($data);

        //$proceso = $this->em->getRepository('ProcesoBundle:Proceso')->find($data['id']);
        // var_dump($data);

        foreach ($data['actividades'] as $actividad) {
              $actividadActual = $this->em->getRepository('ProcesoBundle:Actividad')->find($actividad['id']);
              
              if(($actividad['actSig']==-1) || ($actividad['actSig']==-2)){
                $actividadActual->setActSig(null);
                $actividadActual->setInicioFin($actividad['actSig']);
              }else{
                  $actividadSig = $this->em->getRepository('ProcesoBundle:Actividad')->find($actividad['actSig']);
                  $actividadActual->setActSig($actividadSig);
              }
              $this->em->persist($actividadActual);
              $this->em->flush();
              //$actividadSig->setActAnt($actividadActual);
              if(($actividad['actAnt']==-1) || ($actividad['actAnt']==-2)){
                $actividadActual->setActAnt(null);
                $actividadActual->setInicioFin($actividad['actAnt']);
              }else{
                  $actividadAnt = $this->em->getRepository('ProcesoBundle:Actividad')->find($actividad['actAnt']);
                  $actividadActual->setActAnt($actividadAnt);
              }
              $this->em->persist($actividadActual);
              $this->em->flush();
              //$actividadAnt->setActSig($actividadActual);

              // $this->em->persist($actividadActual);
              // $this->em->persist($actividadSig);
              // $this->em->persist($actividadAnt);

        }
        // $actividadActual = $this->em->getRepository('ProcesoBundle:Actividad')->find(1);
        // $actividadPrueba = $this->em->getRepository('ProcesoBundle:Actividad')->find(2);
        // $actividadActual->setActprueba($actividadPrueba);
        // $this->em->persist($actividadActual);
        // $this->em->flush();
    }
}
