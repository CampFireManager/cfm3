<?php

namespace BKDbTitanic;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

/**
 * Description of Module
 *
 * @author Kathryn Reeve <Kat@BinaryKitten.com>
 */
class Module implements ConsoleBannerProviderInterface,
    ConsoleUsageProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig()
    {
        return array(
            'invokables' => array(
                'BKDbTitanic\Controller\Titanic' => 'BKDbTitanic\Controller\TitanicController'
            )
        );
    }

    public function getConsoleBanner(Console $console)
    {


        return
            " BK Db Titanic - Keep your DB in Sync  Version 0.0.1\n"
        ;
    }

    /**
     * This method is defined in ConsoleUsageProviderInterface
     */
    public function getConsoleUsage(Console $console)
    {
        $console->setColor('1');
        return array(
            'db update' => 'update the database',
        );
    }

}
