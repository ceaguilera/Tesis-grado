<?php
namespace Tati\ProcesoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * El siguiente handler es usado para ejecutar el caso de uso TransferReservationExpiration
 * por medio de un comando en la terminal.
 * 
 * Class AdminCommand
 *
 * @author Joel D. Requena P. <Joel.2005.2@gmail.com>
 * @author Currently Working: Joel D. Requena P.
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
        //print("ejecutado");
        //Se obtiene la fecha actual
        $fechaActual = new \DateTime();
        //Se obtienen todas las actividades solicitadas (revisar lo del $doctrine)
        $actividades = $container->$doctrine->getRepository('ProcesoBundle:ActividadSolicitada')->finBy((array('activa' => true )));

        foreach ($actividades as $actividad) {
            $fechaActivacion = $actividad->getFechaActivacion();
            //$diferencia = se hace la diferencia entre la fecha de activacion y el dia actual 
            //Se verifica si alguna actividad se le vencio el tiempo de ejecucion
            if($diferencia > $actividad->getTiempo()){
                if($actividad->getSolicitante != null)
                {
                    $user = $actividad->getSolicitante()->getUser();
                    $container->get('GeneralService')->generarNotificacion($user,2,$actividad);
                }
                else{
                    $users = $container->$doctrine->getRepository('ProcesoBundle:PerfilResponsable')
                    ->findBy(array('tipoResponsable' => $actividad->getResponsable()->getId()));
                    //Se genera una notificacion a cada usuario que sea de ese tipo de responsable
                    foreach ($users as $userResponsable) {
                       $container->get('GeneralService')->generarNotificacion($userResponsable
                        ->getUser(),2,$actividad);
                    }
                }
            }
        }

        $output->writeln("ejecutado el comando de actividades\n");
        // $command = new TransferReservationExpirationCommand();
        // $response = $container->get('CommandBus')->execute($command);

        // if ($response->getStatusCode() == 200 )
        //     $output->writeln(json_encode($response->getData()));
    }
}