<?php
namespace Cupon\OfertaBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tati\ProcesoBundle\Entity\Proceso as EProceso;
use Tati\ProcesoBundle\Entity\Actividad as EActividad;
use Tati\ProcesoBundle\Entity\Tarea as ETarea;
use Doctrine\ORM\EntityRepository;

class LoadProcesoData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {

        $proceso = new EProceso();

        $proceso->setNombre("Proceso Prueba");
        $proceso->setSlug("Proceso-Prueba");
        $tareas = $manager->getRepository('ProcesoBundle:Tarea')->findAll();
        
       for($i=0;$i<=5;$i++){
        $actividades = new EActividad();
        $actividades->setNombre("Actividad".$i);
        $actividades->setIdActSig($i+1);
        $actividades->setIdActAnt($i-1);
        $actividades->setStatus(true);
        $actividades->setIdResponsable($i);
        $actividades->setTiempo("tiempo".$i);
        $actividades->setProceso($proceso->getId());
        //$tareas = new ETarea;
        for($j=0;$j<=2;$j++){
            $tarea = $tareas[$j];
            $actividades->addTarea($tarea);
            $tarea->addActividade($actividades);
            $tarea = null;
        }
        $manager->persist($actividades);
       }
       $proceso->addActividade($actividades);
       $manager->persist($proceso);
       $manager->flush();

        // //Carga de datos de una tarea nueva
        // for($i=0;$i<=10;$i++){
        //     $Tarea = new ETarea();
        //     $Tarea->setNombre('Tarea'.$i);
        //     $Tarea->setSlug('Tarea'.$i);
        //     $Tarea->setDescripcion('esta tarea se encarga de una cosa tal');
        //     $manager->persist($Tarea);
        //     $tarea = null;
        // }
    }
    public function getOrder()
    {
        return 1;
    }
}