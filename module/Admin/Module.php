<?php

namespace Admin;

/**
 * Admin Module - gives hooks for admin functions
 *
 * @author spriggsj
 */
class Module {
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
}