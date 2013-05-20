<?php

namespace BKDbTitanic;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\Console\Request as ConsoleRequest;

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

    public function onBootstrap(MvcEvent $event)
    {
        $sm = $event->getApplication()->getServiceManager();
        if (!$sm->has('Zend\Db\Adapter\Adapter') && $event->getRequest() instanceof ConsoleRequest) {
            $response = $event->getResponse();
            $response->setContent("BKDbTitanic requires that the Database be configured correctly\n");
            $eventManager = $event->getTarget()->getEventManager();
 
            $eventManager->attach(MvcEvent::EVENT_ROUTE, function() use ($response) { return $response->send(); }, 1000);

        }
    }

}
