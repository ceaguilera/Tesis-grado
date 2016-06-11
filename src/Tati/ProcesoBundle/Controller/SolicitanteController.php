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
use Tati\ProcesoBundle\Entity\Documento as Edocumento;
use Symfony\Component\HttpFoundation\File\File;

class SolicitanteController extends Controller
{

     
    public function holaSolicitanteAction(Request $request)
    {
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
            $actividad = $this->get('RequestService')->requestProcess($data);
            ///var_dump("paso por aqui");
        }

        $response = new JsonResponse($actividad, 200);
        return $response;
    }

    public function listRequestAction(){
        return $this->render('ProcesoBundle:All:Solicitante/listaSolicitudes.html.twig');
    }

    public function uploadedFilesAction(){
        return $this->render('ProcesoBundle:All:Solicitante/archivosSubidos.html.twig');
    }

    public function finishedProcessesAction(){
        return $this->render('ProcesoBundle:All:Solicitante/procesosTerminados.html.twig');
    }

    public function uploadFileAction(Request $request){

            //$data = json_decode($request->getContent()->get('data'),true);
            $file = new File($request->files->get('file'));
            $userName = "Carlos";
            $name = "prueba";
            $documento = new Edocumento();
            $documento->setFile($file);
            $documento->setName($userName);
            $documento->upload($name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();
            var_dump("entro",$file);

            $response = new JsonResponse();
            $response->setData(array(
            'Insertado proceso' => 200));

        return $response;

        
    }

        public function getActividadAction($id){

            $response = $this->get('GeneralService')->getTareas($id);
            return $this->render('ProcesoBundle:All:Solicitante/detalleActividad.html.twig',  array(
                    'data' =>  json_encode($response)
                ));
        
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