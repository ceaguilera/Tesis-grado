<?php
namespace Cupon\OfertaBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tati\ProcesoBundle\Entity\TipoTarea as ETipoTarea;

class LoadTareaData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {
        $tareas = array(
            "Subir archivo",
            "Verificar",
            "Analizar",
            "Aprobar",
            "Respuesta",
        );
        //Carga de datos de una tareas
        foreach ($tareas as $tarea) {
            $tareaNueva = new ETipoTarea();
            $tareaNueva->setNombre($tarea);
            $tareaNueva->setDescripcion(null);
            $manager->persist($tareaNueva);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}