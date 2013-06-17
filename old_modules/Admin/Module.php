<?php

namespace Admin;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

/**
 * Admin Module - gives hooks for admin functions
 *
 * @author spriggsj
 */
class Module implements ConsoleBannerProviderInterface
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

    public function getConsoleBanner(\Zend\Console\Adapter\AdapterInterface $console)
    {
        return
            "==------------------------------------------------------==\n" .
            "        Campfire Manager v3                               \n" .
            "==------------------------------------------------------==\n" .
            "\n"
        ;
    }

}
