<?php

namespace Tati\ProcesoBundle\Resources\Services;

use Tati\ProcesoBundle\Entity\User as EUser;
use Tati\ProcesoBundle\Entity\Departamento as EDep;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUni;
use Tati\ProcesoBundle\Entity\PerfilSolicitante as EPS;
use Tati\ProcesoBundle\Entity\PerfilResponsable as EPR;
use Tati\ProcesoBundle\Entity\Responsable as EResponsanble;

class ResponsableService
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

    public function listaActividadesSol($responsable){

        $response = array();
        $responsabilidades = $responsable->getResponsabilidades();
        foreach ($responsabilidades as $responsabilidad) {
            $actividades = $responsabilidad->getActividadesSolicitadas();
            foreach ($actividades as $actividad) {
                if($actividad->getStatus()==false){
                    $actiAux = array();
                    $actiAux['id'] = $actividad->getId();
                    $actiAux['nombre'] = $actividad->getNombre();
                    $actiAux['descripcion'] = $actividad->getDescripcion();
                    $actiAux['nombreProceso'] = $actividad->getSolicitud()->getProceso()->getNombre();
                    $actiAux['resposable_por'] = $actividad->getResponsable()->getNombre();
                    $actiAux['solicitante'] = $actividad->getSolicitud()->getSolicitante()->getNombre();
                    array_push($response, $actiAux);
                }
            }
        }

        // $actividades = $this->em->getRepository('ProcesoBundle:ActividadSolicitada')->findBy(array(
        // 'responsable' => $responsable, 'activa' => true));

        // $response = array();

        // foreach ($actividades as $actividad) {
        //     $actiAux = array();
        //     $actiAux['id'] = $actividad->getId();
        //     $actiAux['nombre'] = $actividad->getNombre();
        //     $actiAux['descripcion'] = $actividad->getDescripcion();
        //     $actiAux['nombreProceso'] = $actividad->getSolicitud()->getProceso()->getNombre();
        //     array_push($response, $actiAux);
        // }

        return $response;
    }


}
