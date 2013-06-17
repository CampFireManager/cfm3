<?php
namespace Api;
use BKUtil\ModuleUtil;
use Zend\ModuleManager\ModuleManager;

class Module {
    function getConfig() {
        $config = ModuleUtil::getMergedConfigFromDir(__DIR__ . "/config/");
        \Zend\Debug\Debug::dump($config);
        return $config;
    }
    
    function init(ModuleManager $moduleManager) {
        // $moduleManager->loadModule('Talk');
    }
    
    function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
}
