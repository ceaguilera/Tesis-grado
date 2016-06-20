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
            ->setDescription('Verificacion de actividades venciadas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $kernel;
		$container = $kernel->getContainer();
        //print("ejecutado");
        $output->writeln("ejecutado el comando de actividades\n");
        // $command = new TransferReservationExpirationCommand();
        // $response = $container->get('CommandBus')->execute($command);

        // if ($response->getStatusCode() == 200 )
        //     $output->writeln(json_encode($response->getData()));
    }
}