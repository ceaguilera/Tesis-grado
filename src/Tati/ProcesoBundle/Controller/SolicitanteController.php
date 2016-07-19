<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tati\ProcesoBundle\Entity\Tarea;
use Tati\ProcesoBundle\Entity\Responsable;
use Tati\ProcesoBundle\Entity\TareaSolicitada;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Tati\ProcesoBundle\Entity\Documento as Edocumento;
use Symfony\Component\HttpFoundation\File\File;

class SolicitanteController extends Controller
{

     
    public function holaSolicitanteAction(Request $request)
    {
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        $this->get('GeneralService')->getNotificacionesNormales($this->getUser()->getId());
        $user = $this->getUser()->getId();
        $procesos = $this->get('InformationService')->listProcessActive();
        $response['userId'] = $user;
        $response['procesos'] = $procesos;
        return $this->render('ProcesoBundle:All:Solicitante/solicitante.html.twig',  array(
                    'data' =>  json_encode($response)
                ));

    }

    public function RequestprocessAction(Request $request){

        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(),true);
            $data['solicitante'] = $this->getUser();
            $actividad = $this->get('RequestService')->requestProcess($data);
            ///var_dump("paso por aqui");
        }
        if($actividad!=false){
            $response = new JsonResponse($actividad, 200);
        }else{
            $response = new JsonResponse("error, ya tiene una solicitud de este tipo en curso", 500);
        }
        return $response;
    }

    public function listRequestAction(){
        $data['idSolicitante'] = $this->getUser()->getId();
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        $this->get('GeneralService')->getNotificacionesNormales($this->getUser()->getId());
        $response = $this->get('RequestService')->listaActividadesSol($data);
        return $this->render('ProcesoBundle:All:Solicitante/listaSolicitudes.html.twig', array(
                    'data' =>  json_encode($response)
                ));
    }

    public function uploadedFilesAction(){
        return $this->render('ProcesoBundle:All:Solicitante/archivosSubidos.html.twig');
    }

    public function finishedProcessesAction(){
        $this->get('GeneralService')->getNotificacionesAlertas($this->getUser()->getId());
        $this->get('GeneralService')->getNotificacionesNormales($this->getUser()->getId());
        $response = $this->get('RequestService')->procesosTerminados($this->getUser());
        return $this->render('ProcesoBundle:All:Solicitante/procesosTerminados.html.twig', array(
                    'data' =>  json_encode($response)
                ));
    }

    public function uploadFileAction(Request $request){

            //$data = json_decode($request->getContent()->get('data'),true);
            $file = new File($request->files->get('file'));
            // var_dump($request->get('userName'));
            // var_dump($request->get('name'));
            // var_dump($request->get('actividadRelacionada'));

            $userName = $request->get('userName');
            $name = $request->get('name');
            $actividad = $this->getDoctrine()->getRepository('ProcesoBundle:ActividadSolicitada')->find($request->get('actividadRelacionada'));
            $tarea = $this->getDoctrine()->getRepository('ProcesoBundle:TareaSolicitada')->find($request->get('idTarea'));
            $documento = new Edocumento();
            $documento->setFile($file);
            $documento->setName($userName);
            $documento->upload($name,$actividad->getSolicitud()->getNombreCarpeta(),$userName);
            $documento->setActividadesSol($actividad);
            $documento->setTarea($tarea);
            $tarea->setDocumento($documento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();
            $this->get('GeneralService')->setStatusTareasSolicitadas($request->get('idTarea'));
            //var_dump("entro",$file);

            $response = new JsonResponse();
            $response->setData(array(
            'Archivo subido' => 200,
            'path' => $documento->getPath(),
            'fileId' => $documento->getId(),
            'nombre' => $documento->getName()));

        return $response;

        
    }

    public function getActividadAction($id){

            $response = $this->get('GeneralService')->getTareas($id);
            $response['nombreUser'] = $this->getUser()->getUserName();
            return $this->render('ProcesoBundle:All:Solicitante/detalleActividad.html.twig',  array(
                    'data' =>  json_encode($response)
                ));
        
    }

    public function ejecutarActividadAction(Request $request){

        if ($request->isXmlHttpRequest()){
            $data = json_decode($request->getContent(),true);
            $status = $this->get('GeneralService')->setStatusActividadSolicitada($data['idActividad']);
            if($status){
                $response = new JsonResponse("Actividad ejecuada correctamente", 200);
            }else{
                $response = new JsonResponse("Hubo un error, falta alguna tarea por ser ejecutada", 500);
            }
            return $response;
        }
    }

    public function eliminarArchivoAction(Request $request){

        if ($request->isXmlHttpRequest()){
            $data = json_decode($request->getContent(),true);
            $status = $this->get('GeneralService')->eliminarArvhivo($data['idFile']);
            if($status){
                $response = new JsonResponse("Archivo elinado correctamente", 200);
            }else{
                $response = new JsonResponse("Hubo un error", 500);
            }
            return $response;
        }
    }

}



  //   $scope.upload = function () {
  //    console.log($scope.file);

  //    var json = {};
  //    json.userName = "Carlos";
  //    json.name = "prueba";
        // json.file = $scope.file;
        // json = angular.toJson(json);
        // var url= Routing.generate('_tatiSoft_soli_upload');
        // console.log("json",json);
        // $.ajax({
        //  method: 'POST',
        //  data: json,
        //  url: url,
        //  success: function(data) {
        //      console.log(data);
        //  },
        //  error: function(e) {

        //  }
        // })