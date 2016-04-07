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
            $this->get('RequestService')->requestProcess($data);
        }
        $response = new JsonResponse();
            $response->setData(array(
            'Insertado proceso' => 200));

        return $response;
    }


}
