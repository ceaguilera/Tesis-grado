<?php
namespace Cupon\OfertaBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tati\ProcesoBundle\Entity\Responsable as EResponsable;

class LoadResponsableData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {

        //Carga de datos de una tarea nueva
        for($i=0;$i<=10;$i++){
            $Responsable = new EResponsable();
            $Responsable->setNombre('Responsable'.$i);
            $manager->persist($Responsable);
            $Responsable = null;
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}