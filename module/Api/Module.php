<?php
namespace Api;
use BKUtil\ModuleUtil;
use Zend\ModuleManager\ModuleManager;

class Module {
    function getConfig() {
        return ModuleUtil::getMergedConfigFromDir(__DIR__ . "/config/");
    }
    
    function init(ModuleManager $moduleManager) {
        $moduleManager->loadModule('Talk');
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