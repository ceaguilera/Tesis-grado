<?php
namespace Cupon\OfertaBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tati\ProcesoBundle\Entity\Departamento as EDespartamento;

class LoadDepartamentoData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {

        $departamentos = array(
            "Departamento de Computación", 
            "Departamento de Biología", 
            "Departamento de Química", 
            "Departamento de Matemática", 
            "Departamento de Física"
        );

        /*Cargado datos de departamento*/
        foreach ($departamentos as $key => $departamento) {
            $departamentoNuevo = new EDespartamento();
            $departamentoNuevo->setNombre($departamento);
            $manager->persist($departamentoNuevo);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}