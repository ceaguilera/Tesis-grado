<?php
namespace Cupon\OfertaBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;
use Tati\ProcesoBundle\Entity\UnidadAcademica as EUnidad;
use Tati\ProcesoBundle\Entity\Departamento as EDespartamento;

class LoadUnidadesAcademicasData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {
        /*Estructura para los departamentos*/
        $departamentos = array(
            "Departamento de Computación", 
            "Departamento de Biología", 
            "Departamento de Química", 
            "Departamento de Matemática", 
            "Departamento de Física"
        );

        /*Estructura para las unidades academicas*/
        $computacion = array(
            "Algoritmos, Programación y Lenguaje", 
            "Aquitectura. Redes y Sistemas Operativos", 
            "Desarrollo de Software y Sistemas", 
            "Departamento de Matemática", 
            "Matemáticas Computacionales"
        );

        $biologia = array(
            "Ecología y Ambiente", 
            "Biodiversidad Animal", 
            "Biodiversidad Vegetal", 
            "Biología Celular y Biotecnología"
        );

        $quimica = array(
            "Tecnología Química", 
            "Fisicoquímica", 
            "Química Analítica", 
            "Química General",
            "Química Orgánica",
            "Química Inorgánica"
        );

        $matematica = array(
            "Álgebra", 
            "Geometría", 
            "Matemáticas Básicas (Generales)", 
            "Análisis",
            "Estadística Computacional y Probabilidades",
            "Investigación de Operaciones",
            "Investigación de Operaciones"
        );
        $fisica = array(
            "Física Básica", 
            "Física Experimental", 
            "Física Moderna", 
            "Física Coputacional"
        );
        
        $unidades = array(
            $computacion, 
            $biologia, 
            $quimica, 
            $matematica, 
            $fisica
        );

        /*Cargado datos de departamentos y las unidades academicas*/
        foreach ($departamentos as $key => $departamento) {
            $departamentoNuevo = new EDespartamento();
            $departamentoNuevo->setNombre($departamento);
            $manager->persist($departamentoNuevo);
            $unidadAct = $unidades[$key];
            foreach ($unidadAct as $unidad) {
                $unidadNueva = new EUnidad();
                $unidadNueva->setNombre($unidad);
                $unidadNueva->setDepartamento($departamentoNuevo);
                $manager->persist($unidadNueva);
            }

        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 2;
    }
}