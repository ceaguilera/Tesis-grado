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
        $responsables =array(
            "Departamento",
            "Asuntos profesorales",
            "Consejo de facultad",
            "Unidad academica"
            );
        //Carga de datos de una tarea nueva
        foreach ($responsables as $responsable){
            $responsableNuevo = new EResponsable();
            $responsableNuevo->setNombre($responsable);
            $manager->persist($responsableNuevo);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}