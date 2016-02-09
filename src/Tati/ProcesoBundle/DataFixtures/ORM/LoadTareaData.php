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

        //Carga de datos de una tarea nueva
        for($i=0;$i<=10;$i++){
            $TipoTarea = new ETipoTarea();
            $TipoTarea->setNombre('Tipo Tarea'.$i);
            $TipoTarea->setDescripcion('esta tarea se encarga de una cosa tal');
            $manager->persist($TipoTarea);
            $tarea = null;
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}