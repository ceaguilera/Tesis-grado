<?php
namespace Tati\ProcesoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * 
 *
 */
class ASActividadesVencidasCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tati:actividad:vencidas')
            ->setDescription('Agente de software que verifica si hay alguna actividad con el tiempo de ejecucion vencido')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $kernel;
		$container = $kernel->getContainer();
        $em = $container->get('doctrine')->getManager();
        //print("ejecutado");
        //Se obtiene la fecha actual
        $fechaActual = new \DateTime();
        //Se obtienen todas las actividades solicitadas (revisar lo del $doctrine)
        $actividades = $em->getRepository('ProcesoBundle:ActividadSolicitada')->findBy((array('activa' => true, 'notificacionVencida' =>false )));
        if(count($actividades)<=1)
        {
            $output->writeln("Ninguna actividad venciada actualmente\n");
        }
        foreach ($actividades as $actividad) {
            $fechaActivacion = $actividad->getFechaActivacion();
            $diferencia = $actividad->getFechaActivacion()->diff($fechaActual);
            $diferencia = (int)$diferencia->format('%d');
            //$output->writeln($diferencia);
            //se verifica si alguna actividad se le vencio el tiempo de ejecucion
            if($diferencia >= $actividad->getTiempo()){
                if($actividad->getsolicitante() != null)
                {
                    $user = $actividad->getsolicitante()->getuser();
                    $container->get('generalservice')->generarnotificacion($user,2,$actividad);
                    $output->writeln("genero notificaciones a usuario solicitante\n");
                }
                else{
                    $users = $em->getrepository('ProcesoBundle:PerfilResponsable')
                    ->findby((array('responsable' => $actividad->getresponsable()->getid())));
                    //$users = $em->getrepository('procesobundle:perfilresponsable')->findall();
                    $output->writeln("genero notificaciones a usuario responsable\n");
                    //se genera una notificacion a cada usuario que sea de ese tipo de responsable
                    foreach ($users as $userresponsable) {
                       $container->get('generalservice')->generarnotificacion($userresponsable
                        ->getuser(),2,$actividad);
                    }
                }
            }
        }

        
        // $command = new TransferReservationExpirationCommand();
        // $response = $container->get('CommandBus')->execute($command);

        // if ($response->getStatusCode() == 200 )
        //     $output->writeln(json_encode($response->getData()));
    }
}