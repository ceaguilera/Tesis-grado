<?php

namespace Tati\ProcesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function pruebaAction()
    {
        return $this->render('ProcesoBundle:Default:index.html.twig');
    }
}
